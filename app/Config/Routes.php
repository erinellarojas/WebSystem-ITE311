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
$routes->setAutoRoute(false); // Turn off auto-routing to avoid loops

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

$routes->get('dashboard', 'Dashboard::index'); // Make sure Dashboard controller exists

// --------------------------------------------------------------------
// Admin Routes (with authAdmin filter)
// --------------------------------------------------------------------
$routes->group('admin', ['filter' => 'authAdmin'], function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('users', 'AdminController::users');
    $routes->get('courses', 'AdminController::courses');
    $routes->get('settings', 'AdminController::settings');
});

// --------------------------------------------------------------------
// Teacher Routes (with authTeacher filter)
// --------------------------------------------------------------------
$routes->group('teacher', ['filter' => 'authTeacher'], function ($routes) {
    $routes->get('dashboard', 'TeacherController::dashboard');
});

// --------------------------------------------------------------------
// Student Routes (with authStudent filter)
// --------------------------------------------------------------------
$routes->group('student', ['filter' => 'authStudent'], function ($routes) {
    $routes->get('dashboard', 'StudentController::dashboard');
});

// --------------------------------------------------------------------
// Load environment-specific routes
// --------------------------------------------------------------------
$envRoutes = APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
if (file_exists($envRoutes)) {
    require $envRoutes;
}
