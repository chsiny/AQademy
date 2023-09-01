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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/hello', 'Hello::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/check_login', 'Login::check_login');
$routes->get('/login/logout', 'Login::logout');
$routes->post('/upload/upload_file', 'Upload::upload_file');
$routes->post('/upload/profile_picture', 'Upload::profile_picture');
$routes->get('/upload', 'Upload::index');
$routes->get('/user', 'User::index');
$routes->get('/user/register_page', 'User::register_page');
$routes->post('/user/register', 'User::register');
$routes->get('/user/verify_email/(:any)', 'User::verify_email/$1');
$routes->get('forget_password', 'User::forget_password');
$routes->post('send_verification', 'User::send_verification');
$routes->get('user/reset_password_form/(:any)', 'User::reset_password_view/$1');
$routes->post('user/reset_password', 'User::reset_password');
$routes->post('/user/update_profile', 'User::update_profile');
$routes->get('/addPost', 'Home::addPost');
$routes->post('/addPost/create_post', 'Home::createPost');
$routes->get('/post/(:num)', 'Posts::index/$1');
$routes->post('/upvote/(:num)', 'Posts::upvote/$1');
$routes->post('/comments/create', 'Posts::createComment');
$routes->get('/autocomplete', 'Posts::autocomplete');
// $routes->get('/search', 'Posts::search');
$routes->get('/searchPosts', 'Posts::searchPostsView');

$routes->get('movie', 'MovieController::index');
// $routes->match(['get', 'post'], '/search', 'Posts::search');

// milestone3
$routes->post('posts/loadPosts', 'Posts::loadPosts');
$routes->get('bookmark/(:num)', 'Posts::bookmark/$1');
$routes->get('bookmarks', 'Posts::getBookmarks');
$routes->get('bookmarks/(:num)', 'Posts::deleteBookmark/$1');

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
