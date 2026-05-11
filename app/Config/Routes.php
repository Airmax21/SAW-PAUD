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
