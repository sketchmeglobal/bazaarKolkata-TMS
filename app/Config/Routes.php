<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->match(['get', 'post'], 'login', 'AuthController::login');
$routes->match(['get', 'post'], '/do_login', 'AuthController::do_login');

$routes->match(['get', 'post'], '/auth', 'DashboardC::index');

$routes->match(['get', 'post'], '/all-tickets', 'DashboardC::all_tickets');

$routes->group('admin', static function ($routes) {
    $routes->match(['get', 'post'], 'dashboard', 'DashboardC::index');
    $routes->match(['get', 'post'], 'all-tickets', 'DashboardC::all_tickets');
    $routes->match(['get', 'post'], 'profile', 'DashboardC::profile');
    $routes->match(['get', 'post'], 'site-hierancy', 'DashboardC::site_hierancy');
    $routes->match(['get', 'post'], 'sr-association', 'DashboardC::sr_association');
    $routes->match(['get', 'post'], 'severity-mapping', 'DashboardC::severity');
    $routes->match(['get', 'post'], 'intranet-massaging', 'DashboardC::internet_masg');
    $routes->match(['get', 'post'], 'all-users', 'DashboardC::all_users');
    $routes->match(['get', 'post'], 'new-ticket', 'DashboardC::new_ticket');   

});
// FOR VIEW TICKETS ONLY
$routes->group('tickets-view', static function ($routes) {
    $routes->match(['get', 'post'], 'view1', 'DashboardC::view_tickets1');
    $routes->match(['get', 'post'], 'view2', 'DashboardC::view_tickets2');

});


if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}