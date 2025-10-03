<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;

class AuthController extends BaseController
{
    public function __construct()
    {
        // helper form dan url
        helper(['form', 'url']);
        // library session
        $this->session = \Config\Services::session();
    }

    public function showLoginForm()
    {
        // Jika sudah login, redirect ke halaman yang sesuai
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to($this->session->get('role') === 'Admin' ? '/admin/dashboard' : '/public/dashboard');
        }
        return view('auth/login');
    }

    public function processLogin()
    {
        $penggunaModel = new PenggunaModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi input
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('/login')->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = $penggunaModel->getUserByUsername($username);

        // Cek user dan verifikasi password
        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $sessionData = [
                'id_pengguna' => $user['id_pengguna'],
                'username' => $user['username'],
                'nama_lengkap' => $user['nama_depan'] . ' ' . $user['nama_belakang'],
                'role' => $user['role'],
                'isLoggedIn' => TRUE
            ];
            $this->session->set($sessionData);

            // Redirect berdasarkan role
            if ($user['role'] === 'Admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/public/dashboard');
            }
        } else {
            // Jika login gagal
            return redirect()->to('/login')->with('error', 'Username atau Password salah!');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login')->with('success', 'Anda berhasil logout.');
    }
}