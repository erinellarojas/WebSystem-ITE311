<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function() {
    echo view('errors/custom_404'); // optional custom 404 page
});
$routes->setAutoRoute(true);

$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/auth', 'Auth::auth');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');
