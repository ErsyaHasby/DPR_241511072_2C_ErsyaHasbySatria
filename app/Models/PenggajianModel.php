<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggajianModel extends Model
{
    protected $table = 'penggajian';
    protected $primaryKey = 'id_penggajian';
    protected $allowedFields = ['id_anggota', 'id_komponen_gaji'];

    /**
     * Mengecek apakah komponen gaji sudah ada untuk anggota tertentu.
     */
    public function isExist($id_anggota, $id_komponen_gaji)
    {
        return $this->where([
            'id_anggota' => $id_anggota,
            'id_komponen_gaji' => $id_komponen_gaji
        ])->first() !== null;
    }
    public function getPenggajian()
    {
        // Builder untuk query utama
        $builder = $this->db->table('anggota a');
        $builder->select("
        a.id_anggota,
        a.gelar_depan,
        a.nama_depan,
        a.nama_belakang,
        a.gelar_belakang,
        a.jabatan,
        a.status_pernikahan,
        a.jumlah_anak
    ");

        // Subquery untuk menghitung Take Home Pay
        $subQuery = $this->db->table('penggajian p')
            ->join('komponen_gaji k', 'p.id_komponen_gaji = k.id_komponen_gaji')
            ->select("
            SUM(
                CASE
                    WHEN k.nama_komponen = 'Tunjangan Istri/Suami' AND a.status_pernikahan != 'Kawin' THEN 0
                    WHEN k.nama_komponen = 'Tunjangan Anak' AND a.jumlah_anak = 0 THEN 0
                    WHEN k.nama_komponen = 'Tunjangan Anak' AND a.jumlah_anak > 0 THEN k.nominal * LEAST(a.jumlah_anak, 2)
                    ELSE k.nominal
                END
            )
        ")
            ->where('p.id_anggota = a.id_anggota')
            ->where('k.satuan', 'Bulan')
            ->getCompiledSelect();

        $builder->select("({$subQuery}) as take_home_pay");

        $query = $builder->get();
        return $query->getResultArray();
    }
}