<?php

use CodeIgniter\Router\RouteCollection;
// ... (di bagian atas file)
use App\Controllers\AuthController;

// ... (di dalam $routes->get('/', 'Home::index');)

// Rute untuk Autentikasi
$routes->get('/login', [AuthController::class, 'showLoginForm'], ['as' => 'login']);
$routes->post('/login', [AuthController::class, 'processLogin'], ['as' => 'processLogin']);
$routes->get('/logout', [AuthController::class, 'logout'], ['as' => 'logout']);

// Halaman placeholder setelah login
$routes->get('/admin/dashboard', static function () {
    return '<h1>Selamat Datang Admin: ' . session()->get('nama_lengkap') . '</h1><a href="/logout">Logout</a>';
});
$routes->get('/public/dashboard', static function () {
    return '<h1>Selamat Datang Publik: ' . session()->get('nama_lengkap') . '</h1><a href="/logout">Logout</a>';
});