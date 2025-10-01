<?php
$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->post('/auth/doLogin', 'AuthController::doLogin');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/dashboard', 'AuthController::dashboard');
$routes->get('/unauthorized', function () {
    return view('errors/unauthorized');
});