<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->post('/auth/processLogin', 'AuthController::processLogin');
$routes->get('/auth/logout', 'AuthController::logout');
$routes->get('/dashboard', 'AuthController::dashboard');
$routes->get('/testdb', 'TestDbController::index');