<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\PenggunaModel;

class AuthController extends Controller {
    public function login() {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login', ['title' => 'Login']);
    }

    public function doLogin() {
        $model = new PenggunaModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user = $model->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'logged_in' => true,
                'role' => $user['role'],
                'id_pengguna' => $user['id_pengguna'],
                'nama' => $user['nama_depan'] . ' ' . $user['nama_belakang']
            ]);
            return redirect()->to('/dashboard'); // Redirect ke dashboard
        }
        return redirect()->back()->with('error', 'Username atau password salah');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function dashboard() {
        return view('dashboard', ['title' => 'Dashboard']);
    }
}