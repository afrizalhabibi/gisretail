<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('', ['filter' => 'login'], function($routes){
    $routes->get('/', 'Home::index');
    $routes->post('/retaildatafilter', 'Home::retaildatafilter');
    $routes->get('/id', 'Retail::cleannumber');
    $routes->get('/ajax-showretail', 'Retail::showretail');
    $routes->get('/retail', 'Retail::index');
    $routes->get('/addretail', 'Retail::addretail');
    $routes->get('/detailretail/(:any)', 'Retail::retailDetails/$1');
    $routes->post('/doaddretail', 'Retail::doaddretail');
    $routes->post('/doeditretail', 'Retail::doeditretail');
    $routes->post('/dodeleteretail', 'Retail::dodeleteretail');
    
    //Pasar
    $routes->get('/pasar', 'Pasar::index');
    $routes->get('/ajax-pasar', 'Pasar::showpasar');
    $routes->get('/tambahpasar', 'Pasar::addpasar');
    $routes->post('/doaddpasar', 'Pasar::doaddpasar');
    $routes->get('/detailpasar/(:any)', 'Pasar::pasarDetails/$1');
    $routes->post('/doeditpasar', 'Pasar::doeditpasar');
    $routes->post('/dodeletepasar', 'Pasar::dodeletepasar');
    
    //map
    $routes->get('/retailmap', 'Home::retaildata');
    $routes->get('/pasarmap', 'Home::pasardata');
});

