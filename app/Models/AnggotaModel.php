<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';
    protected $allowedFields = [
        'nama_depan',
        'nama_belakang',
        'gelar_depan',
        'gelar_belakang',
        'jabatan',
        'status_pernikahan',
        'jumlah_anak'
    ];
    public function search($keyword)
    {
        return $this->table('anggota')
            ->like('nama_depan', $keyword)
            ->orLike('nama_belakang', $keyword)
            ->orLike('jabatan', $keyword)
            ->orWhere('id_anggota', $keyword)
            ->findAll();
    }
}