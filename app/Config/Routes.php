<?php
$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->post('/auth/doLogin', 'AuthController::doLogin');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/dashboard', 'AuthController::dashboard');
$routes->group('anggota', ['filter' => 'admin', 'namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('create', 'AnggotaController::create');
    $routes->post('store', 'AnggotaController::store');
});
$routes->get('/unauthorized', function () {
    return view('errors/unauthorized');
});