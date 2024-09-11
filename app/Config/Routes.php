<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('home/load_tab/(:any)', 'Home::load_tab/$1');
$routes->post('/home/ekle', 'Home::ekle');
$routes->post('/home/addProductDetail', 'Home::addProductDetail');
$routes->get('/home/getir', 'Home::getir');
$routes->post('/home/update/(:num)', 'Home::update/$1');
$routes->delete('/home/delete/(:num)', 'Home::delete/$1');





