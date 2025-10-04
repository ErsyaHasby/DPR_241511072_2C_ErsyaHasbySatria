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
    $routes->get('anggota/edit/(:num)', 'Admin\AnggotaController::edit/$1');
    $routes->post('anggota/update/(:num)', 'Admin\AnggotaController::update/$1');
    $routes->post('anggota/delete/(:num)', 'Admin\AnggotaController::delete/$1');
    $routes->get('komponen-gaji', 'Admin\KomponenGajiController::index');
    $routes->get('komponen-gaji/tambah', 'Admin\KomponenGajiController::create');
    $routes->post('komponen-gaji/simpan', 'Admin\KomponenGajiController::store');
    $routes->get('komponen-gaji/edit/(:num)', 'Admin\KomponenGajiController::edit/$1');
    $routes->post('komponen-gaji/update/(:num)', 'Admin\KomponenGajiController::update/$1');
    $routes->post('komponen-gaji/delete/(:num)', 'Admin\KomponenGajiController::delete/$1');
    $routes->get('penggajian', 'Admin\PenggajianController::index');
    $routes->get('penggajian/tambah', 'Admin\PenggajianController::create');
    $routes->post('penggajian/simpan', 'Admin\PenggajianController::store');
});

$routes->group('public', ['filter' => 'auth'], static function ($routes) {
    $routes->get('dashboard', static function () {
        return '<h1>Selamat Datang Publik: ' . session()->get('nama_lengkap') . '</h1><a href="/logout">Logout</a>';
    }, ['as' => 'public.dashboard']);
});