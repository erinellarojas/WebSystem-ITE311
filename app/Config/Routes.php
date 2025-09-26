<?php

namespace Config;

use CodeIgniter\Config\Services;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('/', function () {
    $session = \Config\Services::session();

    if ($session->get('isLoggedIn')) {
        switch ($session->get('role')) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'teacher':
                return redirect()->to('/teacher/dashboard');
            case 'student':
                return redirect()->to('/student/dashboard');
            default:
                return redirect()->to('/login');
        }
    }

    return redirect()->to('/login');
});

$routes->get('about', 'Home::about');
$routes->get('contact', 'Home::contact');
$routes->post('contact/submit', 'Home::submitContact');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Auth::dashboard');

$routes->group('admin', function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('users', 'AdminController::users');
    $routes->get('courses', 'AdminController::courses');
    $routes->get('settings', 'AdminController::settings');
});

$routes->group('teacher', function ($routes) {
    $routes->get('dashboard', 'TeacherController::dashboard');
});

$routes->group('student', function ($routes) {
    $routes->get('dashboard', 'StudentController::dashboard');
});

$envRoutes = APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
if (file_exists($envRoutes)) {
    require $envRoutes;
}
