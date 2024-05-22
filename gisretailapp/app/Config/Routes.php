<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/id', 'Retail::cleannumber');
$routes->get('/ajax-showretail', 'Retail::showretail');
$routes->get('/retail', 'Retail::index');
$routes->get('/addretail', 'Retail::addretail');
$routes->get('/detailretail/(:any)', 'Retail::retailDetails/$1');
$routes->post('/doaddretail', 'Retail::doaddretail');
$routes->post('/doeditretail', 'Retail::doeditretail');
$routes->post('/dodeleteretail', 'Retail::dodeleteretail');
