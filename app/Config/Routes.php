<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['get', 'post'], '/', 'AuthController::login');
$routes->match(['get', 'post'], 'login', 'AuthController::login');
$routes->match(['get', 'post'], 'logout', 'AuthController::login');

/*logout*/
//$routes->match(['get', 'post'], '/logout', 'AuthController::logout'); 
$routes->match(['get', 'post'], '/do_login', 'AuthController::do_login');

$routes->match(['get', 'post'], '/auth', 'DashboardC::index');
//$routes->match(['get', 'post'], '/all-tickets', 'DashboardC::all_tickets');

$routes->group('admin', static function ($routes) {
    $routes->match(['get', 'post'], 'dashboard', 'DashboardC::index');

    //Head Office
    $routes->match(['get', 'post'], 'head-office', 'Master\HeadofficeC::index');
    $routes->match(['get', 'post'], 'formValidation', 'Master\HeadofficeC::formValidation');
    $routes->match(['get', 'post'], 'removeTableData', 'Master\HeadofficeC::removeTableData');
    $routes->match(['get', 'post'], 'getTableData', 'Master\HeadofficeC::getTableData');

    //Warehouse
    $routes->match(['get', 'post'], 'warehouse', 'Master\WarehouseC::index');
    $routes->match(['get', 'post'], 'formValidationWH', 'Master\WarehouseC::formValidationWH');
    $routes->match(['get', 'post'], 'removeTableDataWH', 'Master\WarehouseC::removeTableDataWH');
    $routes->match(['get', 'post'], 'getTableDataWH', 'Master\WarehouseC::getTableDataWH');

    //Outlet
    $routes->match(['get', 'post'], 'outlet', 'Master\OutletC::index');
    $routes->match(['get', 'post'], 'formValidationOL', 'Master\OutletC::formValidationOL');
    $routes->match(['get', 'post'], 'removeTableDataOL', 'Master\OutletC::removeTableDataOL');
    $routes->match(['get', 'post'], 'getTableDataOL', 'Master\OutletC::getTableDataOL');

    //Department
    $routes->match(['get', 'post'], 'department', 'Master\DepartmentC::index');
    $routes->match(['get', 'post'], 'formValidationDE', 'Master\DepartmentC::formValidationDE');
    $routes->match(['get', 'post'], 'removeTableDataDE', 'Master\DepartmentC::removeTableDataDE');
    $routes->match(['get', 'post'], 'getTableDataDE', 'Master\DepartmentC::getTableDataDE');

    //Designation
    $routes->match(['get', 'post'], 'designation', 'Master\DesignationC::index');
    $routes->match(['get', 'post'], 'formValidationDG', 'Master\DesignationC::formValidationDG');
    $routes->match(['get', 'post'], 'removeTableDataDG', 'Master\DesignationC::removeTableDataDG');
    $routes->match(['get', 'post'], 'getTableDataDG', 'Master\DesignationC::getTableDataDG');
    $routes->match(['get', 'post'], 'getDesigTableData', 'Master\DesignationC::getDesigTableData');

    //Employee
    $routes->match(['get', 'post'], 'employee', 'Master\EmployeeC::index');
    $routes->match(['get', 'post'], 'formValidationEM', 'Master\EmployeeC::formValidationEM');
    $routes->match(['get', 'post'], 'removeTableDataEM', 'Master\EmployeeC::removeTableDataEM');
    $routes->match(['get', 'post'], 'getTableDataEM', 'Master\DesignationC::getTableDataEM');
    $routes->match(['get', 'post'], 'getDesigTableDataEM', 'Master\EmployeeC::getDesigTableDataEM');
    $routes->match(['get', 'post'], 'getDesignationEM', 'Master\EmployeeC::getDesignationEM');

    //Hardware Name
    $routes->match(['get', 'post'], 'hardware-name', 'Master\HardwareNameC::index');
    $routes->match(['get', 'post'], 'formValidationHW', 'Master\HardwareNameC::formValidationHW');
    $routes->match(['get', 'post'], 'removeTableDataHW', 'Master\HardwareNameC::removeTableDataHW');
    $routes->match(['get', 'post'], 'getTableDataHW', 'Master\HardwareNameC::getTableDataHW');

    //Hardware stock entry
    $routes->match(['get', 'post'], 'hardwarestockentry', 'Master\HardwareStockEntryC::index');
    $routes->match(['get', 'post'], 'formValidationHWS', 'Master\HardwareStockEntryC::formValidationHWS');
    $routes->match(['get', 'post'], 'removeTableDataHWS', 'Master\HardwareStockEntryC::removeTableDataHWS');
    $routes->match(['get', 'post'], 'getTableDataHWS', 'Master\HardwareStockEntryC::getTableDataHWS');

    //severity
    $routes->match(['get', 'post'], 'severity', 'Master\SeverityC::index');
    $routes->match(['get', 'post'], 'formValidationSE', 'Master\SeverityC::formValidationSE');
    $routes->match(['get', 'post'], 'removeTableDataSE', 'Master\SeverityC::removeTableDataSE');
    $routes->match(['get', 'post'], 'getTableDataSE', 'Master\SeverityC::getTableDataSE');

    //Tickets
    $routes->match(['get', 'post'], 'new-ticket', 'NewticketC::index');
    $routes->match(['get', 'post'], 'formValidationTIC', 'NewticketC::formValidationTIC');
    $routes->match(['get', 'post'], 'all-tickets', 'AllticketC::index');
    $routes->match(['get', 'post'], 'view-ticket/(:num)', 'ViewticketC::index/$1');
    $routes->match(['get', 'post'], 'formValidationTICR', 'ViewticketC::formValidationTICR');
    $routes->match(['get', 'post'], 'acceptTicket', 'ViewticketC::acceptTicket');

    //Issue Hardware
    $routes->match(['get', 'post'], 'issue-return-hardware', 'IssuehardwareC::index');
    $routes->match(['get', 'post'], 'check-ticket-status', 'IssuehardwareC::checkTicketStatus');
    $routes->match(['get', 'post'], 'get-hw-serial', 'IssuehardwareC::getHwSerialNo');
    $routes->match(['get', 'post'], 'formValidationHIS', 'IssuehardwareC::formValidationHIS');
    $routes->match(['get', 'post'], 'removeTableDataHIS', 'IssuehardwareC::removeTableDataHIS');
    $routes->match(['get', 'post'], 'getTableDataHIS', 'IssuehardwareC::getTableDataHIS');
    $routes->match(['get', 'post'], 'getDeviceSerialonHIS', 'IssuehardwareC::getDeviceSerialonHIS');

    //Return Hardware
    $routes->match(['get', 'post'], 'return-hardware', 'ReturnhardwareC::index');

    //above links are working


    //$routes->match(['get', 'post'], 'all-tickets', 'DashboardC::all_tickets');
    $routes->match(['get', 'post'], 'profile', 'DashboardC::profile');
    $routes->match(['get', 'post'], 'sr-association', 'DashboardC::sr_association');
    $routes->match(['get', 'post'], 'severity-mapping', 'DashboardC::severity');
    $routes->match(['get', 'post'], 'intranet-massaging', 'DashboardC::internet_masg');
    $routes->match(['get', 'post'], 'all-users', 'DashboardC::all_users');
});

// FOR VIEW TICKETS ONLY
$routes->group('tickets-view', static function ($routes) {
    $routes->match(['get', 'post'], 'view1', 'DashboardC::view_tickets1');
    $routes->match(['get', 'post'], 'view2', 'DashboardC::view_tickets2');
});

$routes->get('/example/customers', 'Example::customers');
$routes->post('/example/customers', 'Example::customers');