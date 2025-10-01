<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\PenggunaModel;

class AuthController extends Controller {
    public function login() {
        if (session()->get('logged_in')) return redirect()->to('/dashboard');
        return view('auth/login');
    }

    public function doLogin() {
        $model = new PenggunaModel();
        $user = $model->getUserByUsername($this->request->getPost('username'));
        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set(['logged_in' => true, 'role' => $user['role'], 'id_pengguna' => $user['id_pengguna']]);
            return redirect()->to('/dashboard');
        }
        return redirect()->back()->with('error', 'Username atau password salah');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }
}