<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
        log_message('debug', 'AuthController initialized');
    }

    public function login()
    {
        if (session()->get('user_id')) {
            log_message('info', 'User already logged in, redirecting to dashboard');
            return redirect()->to('/dashboard');
        }

        log_message('debug', 'Rendering login view');
        return view('auth/login');
    }

    public function processLogin()
    {
        log_message('debug', 'Processing login request');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi input
        if (!$username || !$password) {
            session()->setFlashdata('error', 'Username dan password harus diisi.');
            log_message('error', 'Login failed: Username or password empty');
            return redirect()->to('/login')->withInput();
        }

        // Autentikasi
        try {
            $user = $this->penggunaModel->authenticate($username, $password);
            if ($user) {
                session()->set([
                    'user_id' => $user['id_pengguna'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'nama_depan' => $user['nama_depan'],
                    'nama_belakang' => $user['nama_belakang']
                ]);
                log_message('info', 'Login successful for username: ' . $username);
                return redirect()->to('/dashboard');
            } else {
                session()->setFlashdata('error', 'Username atau password salah.');
                log_message('error', 'Login failed: Invalid credentials for username: ' . $username);
                return redirect()->to('/login')->withInput();
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
            log_message('error', 'Login error: ' . $e->getMessage());
            return redirect()->to('/login')->withInput();
        }
    }

    public function logout()
    {
        log_message('info', 'User logged out: ' . session()->get('username'));
        session()->destroy();
        return redirect()->to('/login');
    }

    public function dashboard()
    {
        if (!session()->get('user_id')) {
            log_message('error', 'Access denied: No active session');
            return redirect()->to('/login');
        }

        $data['role'] = session()->get('role');
        log_message('debug', 'Rendering dashboard for role: ' . $data['role']);
        return view('auth/dashboard', $data);
    }
}