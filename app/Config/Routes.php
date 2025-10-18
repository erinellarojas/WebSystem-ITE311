<?php

namespace Config;

use CodeIgniter\Config\Services;

$routes = Services::routes();

// --------------------------------------------------------------------
// Router Setup
// --------------------------------------------------------------------
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override(fn() => view('errors/custom_404'));
$routes->setAutoRoute(false); // Disable auto routing for security

// --------------------------------------------------------------------
// Public Routes
// --------------------------------------------------------------------
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('auth', 'Auth::auth');
$routes->get('logout', 'Auth::logout');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register');

$routes->get('about', 'Home::about');
$routes->get('contact', 'Home::contact');
$routes->post('contact/submit', 'Home::submitContact');

$routes->post('course/enroll', 'Course::enroll');


$routes->get('dashboard', 'Dashboard::index');


$routes->get('announcements', 'Announcement::index');


$routes->group('admin', ['filter' => 'roleAuth'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('users', 'Admin::users');
    $routes->get('courses', 'Admin::courses');
    $routes->get('settings', 'Admin::settings');
});


$routes->group('teacher', ['filter' => 'roleAuth'], function ($routes) {
    $routes->get('dashboard', 'Teacher::dashboard');
});


$routes->group('student', ['filter' => 'roleAuth'], function ($routes) {
    $routes->get('dashboard', 'Student::dashboard');
});


$envRoutes = APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
if (file_exists($envRoutes)) {
    require $envRoutes;
}
