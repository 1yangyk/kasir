<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'barang::index');
$routes->get('/register', 'register::index');
$routes->get('/user', 'users::index');

$routes->get('/barang', 'barang::index');
$routes->get('/barang/tambah', 'barang::tambah');
$routes->post('/barang/simpan', 'barang::simpan');
$routes->post('/barang/update/(:num)', 'barang::update/$1');
$routes->get('/barang/edit/(:num)', 'barang::edit/$1');
$routes->delete('/barang/(:num)', 'barang::delete/$1');

$routes->get('/pelanggan', 'pelanggan::index');
$routes->get('/pelanggan/tambah', 'pelanggan::tambah');
$routes->post('/pelanggan/simpan', 'pelanggan::simpan');
$routes->post('/pelanggan/update/(:num)', 'pelanggan::update/$1');
$routes->get('/pelanggan/edit/(:num)', 'pelanggan::edit/$1');
$routes->delete('/pelanggan/(:num)', 'pelanggan::delete/$1');

$routes->get('/manage', 'users::manage', ['filter' => 'role:admin']);
$routes->match(['post'],'/', 'users::manage');
$routes->get('/manage/user', 'users::manage', ['filter' => 'role:admin']);
$routes->get('/manage/edit/(:num)', 'users::edit/$1', ['filter' => 'role:admin']);
$routes->post('/manage/update/(:num)', 'users::update/$1', ['filter' => 'role:admin']);
$routes->delete('/manage/(:num)', 'users::delete/$1', ['filter' => 'role:admin']);

$routes->get('/transaksi', 'transaksi::index');
$routes->post('/transaksi/delete', 'transaksi::simpan');
$routes->post('/transaksi/keranjang', 'transaksi::simpan');
$routes->get('/transaksi/keranjang', 'transaksi::simpan');