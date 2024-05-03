<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/id', 'Home::cleannumber');
$routes->get('/ajax-showretail', 'Retail::showretail');
$routes->get('/retail', 'Retail::index');
