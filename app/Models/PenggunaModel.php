<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'nama_depan', 'nama_belakang', 'role'];

    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}