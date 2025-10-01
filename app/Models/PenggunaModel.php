<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DatabaseException;

class PenggunaModel extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $allowedFields = ['username', 'password', 'email', 'nama_depan', 'nama_belakang', 'role'];

    public function authenticate($username, $password)
    {
        log_message('debug', 'Attempting to authenticate username: ' . $username);
        try {
            $db = \Config\Database::connect();
            if (!$db->connID) {
                log_message('error', 'Failed to connect to database');
                throw new DatabaseException('Unable to connect to the database');
            }
            $user = $this->where('username', $username)->first();
            if (!$user) {
                log_message('error', 'User not found for username: ' . $username);
                return null;
            }
            log_message('debug', 'User found: ' . json_encode($user));
            if (password_verify($password, $user['password'])) {
                log_message('debug', 'Password verified for username: ' . $username);
                return $user;
            }
            log_message('error', 'Password verification failed for username: ' . $username);
            return null;
        } catch (DatabaseException $e) {
            log_message('error', 'Database error in authenticate: ' . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            log_message('error', 'Unexpected error in authenticate: ' . $e->getMessage());
            throw $e;
        }
    }
}