<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  pegawai routes
$routes->get('/', 'Pegawai::index');
$routes->get('/add', 'Pegawai::add');
$routes->get('/edit/(:num)', 'Pegawai::edit/$1');
$routes->post('/edit/(:num)', 'Pegawai::edit/$1');
$routes->post('/add', 'Pegawai::add');
$routes->delete('/delete/(:num)', 'Pegawai::delete/$1');


// hari routes
$routes->get('/hari', 'Hari::index');

// absensi routes
$routes->get('/absensi', 'Absensi::index');
$routes->get('/absensi/add', 'Absensi::add');
$routes->post('/absensi/add', 'Absensi::add');
$routes->delete('/absensi/delete/(:num)', 'Absensi::delete/$1');

// Laporan routes
$routes->get('/laporan', 'Laporan::index');
$routes->post('/laporan/cetak', 'Laporan::cetak');



