<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/board', 'Board::list');
$routes->get('/board/write', 'Board::write');
$routes->match(['get', 'post'], 'writeSave', 'Board::save');
$routes->get('/boardView/(:num)', 'Board::view/$1');

$routes->get('/modify/(:num)', 'Board::modify/$1');
$routes->get('/delete/(:num)', 'Board::delete/$1');

$routes->get('/login', 'Member::login');
$routes->get('/logout', 'Member::logout');
$routes->match(['get', 'post'], 'loginOk', 'Member::loginok');
