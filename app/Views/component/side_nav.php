<!-- Sidebar Start -->
<?php         
    $session = session();
    $logged_in = $session->logged_in;
    $emp_name = $session->emp_name;
    $user_level_name = $session->user_level_name;
?>
        <div class="sidebar pb-3">
            <nav class="navbar">
                <div class="bg-primary text-center w-100 mb-3">
                    <a href="<?= base_url('admin/dashboard') ?>" class=""> <!-- navbar-brand -->
                        <img src="http://sketchmeglobal.com/demo-baazarkolkata-pms/dist/assets/img/logo.png" style="height:50px" class="d-block mx-auto" />
                        <h5 class="text-light"><?=COMPANY_SHORT_NAME?></h5>
                    </a>
                </div>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="<?= base_url('assets/img/user.jpg') ?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white"><?=$emp_name?></h6>
                        <span class="text-light"><?=$user_level_name?></span>
                    </div>
                </div>
                
                <?php
                $session = session();
                if($session->user_level == '1') {
                    $router = service('router'); 
                    $controller  = $router->controllerName();  
                    $words = explode('\\', $controller);
                    $showword = trim($words[count($words) - 1], '\\');
                    //echo 'showword: '. $showword;

                    $dashboard_show_hide = '';
                    if($showword == 'DashboardC'){
                        $dashboard_show_hide = 'active';
                    }

                    $master_show_hide = '';
                    if($showword == 'HeadofficeC' || $showword == 'WarehouseC' || $showword == 'OutletC' || $showword == 'DepartmentC' || $showword == 'DesignationC' || $showword == 'EmployeeC' || $showword == 'HardwareNameC' || $showword == 'HardwareStockEntryC' || $showword == 'SeverityC' || $showword == 'HolidayC' || $showword == 'TicketopicC' || $showword == 'TickecategoryC' || $showword == 'SolutionsC'){
                        $master_show_hide = 'show active';
                    }

                    $tickets_show_hide = '';
                    if($showword == 'NewticketC' || $showword == 'AllticketC' || $showword == 'ViewticketC'){
                        $tickets_show_hide = 'show active';
                    }

                    $hardware_show_hide = '';
                    if($showword == 'IssuehardwareC'){
                        $hardware_show_hide = 'show active';
                    }
                ?>
                
                <div class="navbar-nav w-100">
                    <a href="<?= base_url('admin/dashboard') ?>" class="nav-item nav-link <?=$dashboard_show_hide?>"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?=$master_show_hide?>" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Masters</a>
                        <div class="dropdown-menu bg-transparent border-0 <?=$master_show_hide?>">
                            <a href="<?= base_URL('admin/head-office')?>" class="dropdown-item <?=($showword == 'HeadofficeC') ? 'active' : ''?>">Head Office</a>
                            <a href="<?= base_URL('admin/warehouse')?>" class="dropdown-item <?=($showword == 'WarehouseC') ? 'active' : ''?>">Warehouse</a>
                            <a href="<?= base_URL('admin/outlet')?>" class="dropdown-item <?=($showword == 'OutletC') ? 'active' : ''?>">Outlet</a>
                            <a href="<?= base_URL('admin/department')?>" class="dropdown-item <?=($showword == 'DepartmentC') ? 'active' : ''?>">Department</a>
                            <a href="<?= base_URL('admin/designation')?>" class="dropdown-item <?=($showword == 'DesignationC') ? 'active' : ''?>">Designation</a>
                            <a href="<?= base_URL('admin/employee')?>" class="dropdown-item <?=($showword == 'EmployeeC') ? 'active' : ''?>">Employee</a>
                            <a href="<?= base_URL('admin/hardware-name')?>" class="dropdown-item <?=($showword == 'HardwareNameC') ? 'active' : ''?>">Hardware Name</a>
                            <a href="<?= base_URL('admin/hardwarestockentry')?>" class="dropdown-item <?=($showword == 'HardwareStockEntryC') ? 'active' : ''?>">H/W Stock Entry</a>
                            <a href="<?= base_URL('admin/severity')?>" class="dropdown-item <?=($showword == 'SeverityC') ? 'active' : ''?>">Severity</a>
                            <a href="<?= base_URL('admin/holiday')?>" class="dropdown-item <?=($showword == 'HolidayC') ? 'active' : ''?>">Holiday</a>
                            <a href="<?= base_URL('admin/ticket-topic')?>" class="dropdown-item <?=($showword == 'TicketopicC') ? 'active' : ''?>">Ticket Topic</a>
                            <a href="<?= base_URL('admin/ticket-category')?>" class="dropdown-item <?=($showword == 'TickecategoryC') ? 'active' : ''?>">Ticket Category</a>
                            <a href="<?= base_URL('admin/solutions')?>" class="dropdown-item <?=($showword == 'SolutionsC') ? 'active' : ''?>">Solutions</a>
                        </div>
                        <?php } ?>                    
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?=$tickets_show_hide?>" data-bs-toggle="dropdown"><i class="fa fa-list me-2"></i>Tickets</a>
                        <div class="dropdown-menu bg-transparent border-0 <?=$tickets_show_hide?>">
                            <a href="<?= base_url('admin/new-ticket')  ?>" class="dropdown-item <?=($showword == 'NewticketC') ? 'active' : ''?>">New Ticket </a>
                            <a href="<?= base_url('admin/all-tickets')  ?>" class="dropdown-item <?=($showword == 'AllticketC' || $showword == 'ViewticketC') ? 'active' : ''?>">All Tickets</a>
                        </div>
                    </div>
                    
                    <?php if($session->user_level == '1' || $session->user_level == '3'){ ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?=$hardware_show_hide?>" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Hardware</a>
                        <div class="dropdown-menu bg-transparent border-0 <?=$hardware_show_hide?>">
                            <a href="<?= base_url('admin/issue-return-hardware') ?>" class="dropdown-item <?=($showword == 'IssuehardwareC') ? 'active' : ''?>">Issue / Return</a>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- <a href="<?= base_url('admin/profile')  ?>" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Profile</a> -->
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->