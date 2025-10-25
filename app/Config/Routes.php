<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Auth::login');

$routes->get('/dashboard', 'Auth::dashboard');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');

$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');

$routes->get('/logout', 'Auth::logout');


$routes->get('teacher/courses', 'Teacher::index');
$routes->get('teacher/upload', 'Teacher::upload');      
$routes->get('teacher/materials', 'Teacher::materials'); 


$routes->get('student/dashboard', 'Student::dashboard');


$routes->post('course/enroll', 'Course::enroll');


$routes->get('/admin/course/(:num)/upload', 'Material::upload/$1');
$routes->post('/admin/course/(:num)/upload', 'Material::upload/$1');
$routes->get('/materials/delete/(:num)', 'Material::delete/$1');
$routes->get('/materials/download/(:num)', 'Material::download/$1');


$routes->get('materials', 'Material::index');


$routes->get('test', 'TestController::index');
