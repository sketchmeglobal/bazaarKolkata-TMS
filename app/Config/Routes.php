<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['get', 'post'], '/', 'AuthController::login');
$routes->match(['get', 'post'], 'login', 'AuthController::login');
/*logout*/
$routes->match(['get', 'post'], '/logout', 'AuthController::logout'); 
$routes->match(['get', 'post'], '/do_login', 'AuthController::do_login');

$routes->match(['get', 'post'], '/auth', 'DashboardC::index');

$routes->match(['get', 'post'], '/all-tickets', 'DashboardC::all_tickets');

$routes->group('admin', static function ($routes) {
    $routes->match(['get', 'post'], 'dashboard', 'DashboardC::index');

    $routes->match(['get', 'post'], 'head-office', 'Master\HeadofficeC::index');
    $routes->match(['get', 'post'], 'formValidation', 'Master\HeadofficeC::formValidation');
    $routes->match(['get', 'post'], 'removeTableData', 'Master\HeadofficeC::removeTableData');
    $routes->match(['get', 'post'], 'getTableData', 'Master\HeadofficeC::getTableData');

    $routes->match(['get', 'post'], 'warehouse', 'Master\WarehouseC::index');
    $routes->match(['get', 'post'], 'outlet', 'Master\OutletC::index');
    $routes->match(['get', 'post'], 'department', 'Master\DepartmentC::index');
    $routes->match(['get', 'post'], 'hierarchy', 'Master\HierarchyC::index');
    $routes->match(['get', 'post'], 'employee', 'Master\EmployeeC::index');
    $routes->match(['get', 'post'], 'hardware-name', 'Master\HardwareNameC::index');
    $routes->match(['get', 'post'], 'hardwarestockentry', 'Master\HardwareStockEntryC::index');

    $routes->match(['get', 'post'], 'all-tickets', 'DashboardC::all_tickets');
    $routes->match(['get', 'post'], 'profile', 'DashboardC::profile');
    $routes->match(['get', 'post'], 'sr-association', 'DashboardC::sr_association');
    $routes->match(['get', 'post'], 'severity-mapping', 'DashboardC::severity');
    $routes->match(['get', 'post'], 'intranet-massaging', 'DashboardC::internet_masg');
    $routes->match(['get', 'post'], 'all-users', 'DashboardC::all_users');
    $routes->match(['get', 'post'], 'new-ticket', 'DashboardC::new_ticket');
    
    $routes->match(['get', 'post'], 'issue-hardware', 'IssuehardwareC::index');
    $routes->match(['get', 'post'], 'return-hardware', 'ReturnhardwareC::index');

     
});
// FOR VIEW TICKETS ONLY
$routes->group('tickets-view', static function ($routes) {
    $routes->match(['get', 'post'], 'view1', 'DashboardC::view_tickets1');
    $routes->match(['get', 'post'], 'view2', 'DashboardC::view_tickets2');
});

$routes->get('/example/customers', 'Example::customers');
$routes->post('/example/customers', 'Example::customers');