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
                <div class="navbar-nav w-100">
                    <a href="<?= base_url('admin/dashboard') ?>" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

                    <div class="nav-item dropdown">
                        <?php
                        $session = session();
                        if($session->user_level == '1') {
                        ?>
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Masters</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="<?= base_URL('admin/head-office')?>" class="dropdown-item">Head Office</a>
                            <a href="<?= base_URL('admin/warehouse')?>" class="dropdown-item">Warehouse</a>
                            <a href="<?= base_URL('admin/outlet')?>" class="dropdown-item">Outlet</a>
                            <a href="<?= base_URL('admin/department')?>" class="dropdown-item">Department</a>
                            <a href="<?= base_URL('admin/designation')?>" class="dropdown-item">Designation</a>
                            <a href="<?= base_URL('admin/employee')?>" class="dropdown-item">Employee</a>
                            <a href="<?= base_URL('admin/hardware-name')?>" class="dropdown-item">Hardware Name</a>
                            <a href="<?= base_URL('admin/hardwarestockentry')?>" class="dropdown-item">H/W Stock Entry</a>
                            <a href="<?= base_URL('admin/severity')?>" class="dropdown-item">Severity</a>
                            <a href="<?= base_URL('admin/holiday')?>" class="dropdown-item">Holiday</a>
                        </div>
                        <?php } ?>
                        <!-- <div class="dropdown-menu bg-transparent border-0">
                            <a href="<?= base_URL('admin/site-hierancy')?>" class="dropdown-item">Site Hierarchy</a>
                            <a href="<?= base_URL('admin/sr-association')?>" class="dropdown-item">SR Association</a>
                            <a href="<?= base_URL('admin/severity-mapping')?>" class="dropdown-item">Severity Mapping</a>
                            <a href="<?= base_URL('admin/intranet-massaging')?>" class="dropdown-item">Intranet Massaging</a>
                        </div> -->
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-list me-2"></i>Tickets</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="<?= base_url('admin/new-ticket')  ?>" class="dropdown-item">New Ticket </a>
                            <a href="<?= base_url('admin/all-tickets')  ?>" class="dropdown-item">All Tickets</a>
                            <!-- <a href="<?= base_url('admin/all-tickets')  ?>" class="dropdown-item">Unassigned Tickets</a>
                            <a href="<?= base_url('admin/all-tickets')  ?>" class="dropdown-item">Assigned Tickets</a>
                            <a href="<?= base_url('admin/all-tickets')  ?>" class="dropdown-item">Closed Ticket</a>
                            <a href="<?= base_url('admin/all-tickets')  ?>" class="dropdown-item">My Tickets</a>
                            <a href="<?= base_url('admin/all-tickets')  ?>" class="dropdown-item">Following</a> -->
                        </div>
                    </div>

                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Users</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="<?= base_url('admin/all-users') ?>" class="dropdown-item">All Users</a>
                        </div>
                    </div> -->
                    <?php if($session->user_level == '1' || $session->user_level == '3'){ ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Hardware</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="<?= base_url('admin/issue-return-hardware') ?>" class="dropdown-item">Issue / Return</a>
                            <!-- <a href="<?= base_url('admin/issue-hardware') ?>" class="dropdown-item">Issue</a>
                            <a href="<?= base_url('admin/return-hardware') ?>" class="dropdown-item">Return</a> -->
                        </div>
                    </div>
                    <?php } ?>

                    <!-- <a href="<?= base_url('admin/profile')  ?>" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Profile</a> -->
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->