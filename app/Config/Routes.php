<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('ranking', 'Ranking::index');

$routes->group('student', function ($routes) {
    $routes->get('/', 'Student::index');
    $routes->get('create', 'Student::create');
    $routes->post('store', 'Student::store');
    $routes->get('edit/(:num)', 'Student::edit/$1');
    $routes->post('update/(:num)', 'Student::update/$1');
    $routes->get('delete/(:num)', 'Student::delete/$1');
});

$routes->group('class', function ($routes) {
    $routes->get('/', 'ClassController::index');
    $routes->post('store', 'ClassController::store');
    $routes->get('delete/(:num)', 'ClassController::delete/$1');
});

$routes->group('criteria', function ($routes) {
    $routes->get('/', 'Criteria::index');

    $routes->post('update', 'Criteria::update');

    $routes->post('store', 'Criteria::store');
    $routes->get('delete/(:num)', 'Criteria::delete/$1');
});

$routes->group('evaluation', function ($routes) {
    $routes->get('/', 'Evaluation::index');
    $routes->post('store', 'Evaluation::store');
});
