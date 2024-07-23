<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index');

// route login
$routes->get('auth/index', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->post('/add_Mahasiswa', 'Auth::add');
$routes->get('/logout', 'Auth::logout');

$routes->get('Layouts/Dashboard', 'Dashboard::index');

//route pembayaran
$routes->get('/list_pembayaran', 'Pembayaran::index');
$routes->post('payment/token', 'Pembayaran::token');
$routes->get('/list_mahasiswa12', 'List_controller::index');
$routes->get('/pembayaran', 'Payment_controller::index');
$routes->get('/pembayaran_user/(:num)', 'Payment_controller::Payment_user/$1');
$routes->get('/pembayaran_tambah', 'Payment_controller::addInvoice');
$routes->get('/pembayaran_list', 'Payment_controller::selectUser');
$routes->get('/payment/userPayments/(:num)', 'Payment_controller::userPaymentsView/$1');

// $routes->get('/arsip/edit/(:num)', "arsip::edit/$1");



// list mahasiswa
$routes->get('/list_mahasiswa', 'Mahasiswa_controller::index');
$routes->get('/add_mahasiswa', 'Mahasiswa_controller::add_data');
$routes->post('/add_user_mahasiswa', 'Mahasiswa_controller::add');
$routes->get('/tahun_ajaran', 'Mahasiswa_controller::tahun');
$routes->get('/tambah_ajaran', 'Mahasiswa_controller::add_tahun_page');
$routes->post('/tambah_ajaran_baru', 'Mahasiswa_controller::add_tahun');
$routes->get('/edit_tahun_page/(:num)', 'Mahasiswa_controller::page_edit/$1');
$routes->post('/edit_tahun/(:num)', 'Mahasiswa_controller::edit/$1');
$routes->get('/delete_tahun/(:num)', 'Mahasiswa_controller::delete/$1');
$routes->get('/semester', 'Mahasiswa_controller::list_semester');
