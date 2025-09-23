<?php

namespace Config;

use CodeIgniter\Config\Services;

$routes = Services::routes();

// Router setup
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// Public routes
$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');
$routes->get('contact', 'Home::contact');
$routes->post('contact/submit', 'Home::submitContact');

// Authentication routes
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Auth::dashboard');

// Role-based dashboards
$routes->group('admin', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('users', 'AdminController::users');
    $routes->get('patients', 'AdminController::patients');
    $routes->get('appointments', 'AdminController::appointments');
    $routes->get('billing', 'AdminController::billing');
    $routes->get('pharmacy', 'AdminController::pharmacy');
    $routes->get('reports', 'AdminController::reports');
    $routes->get('settings', 'AdminController::settings');
});

$routes->group('teacher', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('dashboard', 'TeacherController::dashboard');
});

$routes->group('student', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('dashboard', 'StudentController::dashboard');
});

// Load environment-specific routes if available
$envRoutes = APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
if (file_exists($envRoutes)) {
    require $envRoutes;
}
