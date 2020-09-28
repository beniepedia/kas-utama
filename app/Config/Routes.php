<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Dashboard::index');


// ['filter' => 'noauth'], 
// $routes->group('', function ($routes) {
// $routes->get('/dashboard', 'Dashboard::index');
// $routes->get('/kategori', 'Kategori::index',);
// $routes->get('/kas_umum', 'Kas_umum::index');
// $routes->get('/anggota', 'Anggota::index');
// $routes->get('/keluar', 'Auth\Login::keluar');

// $routes->add('level-user', 'Level_user::index');
// $routes->add('level-user/loadData', 'Level_user::loadData');
// $routes->add('level-user/form_modal', 'Level_user::form_modal');
// $routes->add('pengaturan/level/form-data', 'Level_user::form_data');
// });

$routes->group('hak-akses', function ($routes) {
	$routes->add('', 'Level_user::index');
	$routes->add('loadData', 'Level_user::loadData');
	$routes->add('form_modal', 'Level_user::form_modal');
	$routes->add('ubah', 'Level_user::ubah');
	$routes->add('proses', 'Level_user::proses');
	$routes->add('hapus', 'Level_user::hapus');
});

$routes->get('/', 'Auth::login', ['filter' => 'auth']);
$routes->get('/login', 'Auth::login', ['filter' => 'auth']);
$routes->get('/register', 'Auth::register', ['filter' => 'auth']);
$routes->get('/verifikasi/(:any)', 'Auth::verifikasi/$1', ['filter' => 'auth']);
$routes->get('/reset-password', 'Auth::reset_password', ['filter' => 'auth']);


$routes->get('access_blocked', 'Access_blocked::index');


/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
