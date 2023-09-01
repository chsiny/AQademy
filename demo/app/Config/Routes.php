<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
//$routes->get('/', 'Helloworld::index');
//$routes->get('/helloworld/', 'Helloworld::index');
//$routes->get('/helloworld/(:any)', 'Helloworld::index/$1/$2');


//$routes->setPrioritize();
//$routes->get('/(:any)', 'Home::index', ['priority' => 1]);
//$routes->get('/admin', 'Helloworld::index/2020/2023');
//$routes->get('/', 'Home::index');
//$routes->get('/', 'Helloworld::index/2020/2023');

$routes->get('form', 'FormController::getFormData');
$routes->post('/(.*)/form', 'FormController::getFormData');

$routes->get('image','ImageController::index');
$routes->post('/(.*)/upload','ImageController::upload');
$routes->get('image/getFiles','ImageController::getFiles');
$routes->get('image/zipFiles','ImageController::zipFiles');
$routes->get('image/delFiles','ImageController::delFiles');

$routes->get('email','EmailController::index');
$routes->post('/(.*)/send','EmailController::send');

$routes->get('publication/','Papers::index');
$routes->get('publication/(:num)','Papers::paperLookupByYear/$1');
//$routes->get('/publication/(:any)','Papers::paperLookup');

$routes->get('publication/display','Papers::display2');
$routes->get('publication/display','Papers::display3');
$routes->get('publication/display','Papers::display1');

//$routes->setPrioritize();
//$routes->get('/(.*)', 'Home::index', ['priority' => 1]);
//$routes->get('/admin', 'Helloworld::comment');

$routes->get('/reqdemo','Request_demo::index');

$routes->get('/auth/login','AuthController::login');
$routes->post('/(.*)/login','AuthController::login');
$routes->get('/(.*)/logout','AuthController::logout');

$routes->get('/(.*)/ajax', 'AuthController::getAJAXResult');
$routes->match(['get','post'],'/(.*)/ajax', 'AuthController::getAJAXResult');








/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
