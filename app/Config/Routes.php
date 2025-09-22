<?php

namespace Config;

use CodeIgniter\Config\Services;

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system’s routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// Router setup
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// --------------------------------------------------------------------
// Route Definitions
// --------------------------------------------------------------------

// Default route
$routes->get('/', 'Home::index');

// General site routes
$routes->get('about', 'Home::about');
$routes->get('contact', 'Home::contact');

// POST routes (for forms)
$routes->post('contact/submit', 'Home::submitContact');

// Authentication routes
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Auth::dashboard');

// Admin routes group example
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
});

// Environment-based routes (development, production, etc.)
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
