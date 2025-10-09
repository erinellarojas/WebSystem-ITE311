<?php

<<<<<<< HEAD
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
=======
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
>>>>>>> 898cc8a9ba3b665aa087f60ba3366d7bdbd719e3
