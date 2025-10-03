<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'AuthController::showLoginForm', ['as' => 'login']);
$routes->post('/login', 'AuthController::processLogin', ['as' => 'processLogin']);
$routes->get('/logout', 'AuthController::logout', ['as' => 'logout']);

$routes->group('admin', ['filter' => 'auth'], static function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index', ['as' => 'admin.dashboard']);

    $routes->get('anggota', 'Admin\AnggotaController::index', ['as' => 'admin.anggota.index']);
    $routes->get('anggota/tambah', 'Admin\AnggotaController::create', ['as' => 'admin.anggota.create']);
    $routes->post('anggota/simpan', 'Admin\AnggotaController::store', ['as' => 'admin.anggota.store']);
});

$routes->group('public', ['filter' => 'auth'], static function ($routes) {
    $routes->get('dashboard', static function () {
        return '<h1>Selamat Datang Publik: ' . session()->get('nama_lengkap') . '</h1><a href="/logout">Logout</a>';
    }, ['as' => 'public.dashboard']);
});