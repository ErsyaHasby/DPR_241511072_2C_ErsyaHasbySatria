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
    // Dashboard
    $routes->get('dashboard', 'Admin\DashboardController::index', ['as' => 'admin.dashboard']);

    // Anggota
    $routes->get('anggota', 'Admin\AnggotaController::index', ['as' => 'admin.anggota.index']);
    $routes->get('anggota/tambah', 'Admin\AnggotaController::create', ['as' => 'admin.anggota.create']);
    $routes->post('anggota/simpan', 'Admin\AnggotaController::store', ['as' => 'admin.anggota.store']);
    $routes->get('anggota/edit/(:num)', 'Admin\AnggotaController::edit/$1');
    $routes->post('anggota/update/(:num)', 'Admin\AnggotaController::update/$1');
    $routes->post('anggota/delete/(:num)', 'Admin\AnggotaController::delete/$1');

    // Komponen Gaji
    $routes->get('komponen-gaji', 'Admin\KomponenGajiController::index');
    $routes->get('komponen-gaji/tambah', 'Admin\KomponenGajiController::create');
    $routes->post('komponen-gaji/simpan', 'Admin\KomponenGajiController::store');
    $routes->get('komponen-gaji/edit/(:num)', 'Admin\KomponenGajiController::edit/$1');
    $routes->post('komponen-gaji/update/(:num)', 'Admin\KomponenGajiController::update/$1');
    $routes->post('komponen-gaji/delete/(:num)', 'Admin\KomponenGajiController::delete/$1');

    // Penggajian
    $routes->get('penggajian', 'Admin\PenggajianController::index');
    $routes->get('penggajian/tambah', 'Admin\PenggajianController::create');
    $routes->post('penggajian/simpan', 'Admin\PenggajianController::store');
    $routes->get('penggajian/detail/(:num)', 'Admin\PenggajianController::detail/$1'); // Pastikan ini ada
    $routes->get('penggajian/edit/(:num)', 'Admin\PenggajianController::edit/$1');
    $routes->post('penggajian/update/(:num)', 'Admin\PenggajianController::update/$1');
    $routes->post('penggajian/delete/(:num)', 'Admin\PenggajianController::delete/$1');
});