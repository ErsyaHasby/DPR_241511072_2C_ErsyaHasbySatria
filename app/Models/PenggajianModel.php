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
}