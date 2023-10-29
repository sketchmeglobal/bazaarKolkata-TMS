<?= view('component/header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />


</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- SIDE-NAV-START -->
        <?= view('component/side_nav') ?>
        <!-- SIDE-NAV-END -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?= view('component/top_nav') ?>
            <!-- Navbar End -->
            <div class="container">
                <div class="row justify-content-center">
                <div class="container-fluid">
                      <nav aria-label="breadcrumb" class="row bg-breadcrumb">
                        <ol class="breadcrumb my-0 ms-2">
                          <li class="breadcrumb-item">
                            <span>Home</span>
                          </li>
                          <li class="breadcrumb-item active"><span>All Tickets</span></li>
                        </ol>
                      </nav>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row bg-light">
                    <div class="col-md-12 my-2 px-4">
                        <div class="row">
                            <div class=" col-md-3 form-group">
                                <label class="control-label alpaca-control-label" for="alpaca3">Assigned To</label>
                                <input type="text" id="alpaca3" name="assign_to" class="alpaca-control form-control"
                                    autocomplete="off">
                            </div>
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="exampleFormControlSelect1">Example select</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>None</option>
                                    <option>Closed</option>
                                    <option>In-progress</option>
                                    <option>Open</option>

                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="exampleFormControlSelect1">Priority</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>None</option>
                                    <option>High</option>
                                    <option>Low</option>
                                    <option>Medium</option>

                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="exampleFormControlSelect1">Severity</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>None</option>
                                    <option>High</option>
                                    <option>Low</option>
                                    <option>Medium</option>

                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 form-group mt-3">
                                <label for="exampleFormControlSelect1">Category</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>Access and Authorization</option>
                                    <option>Bug</option>
                                    <option>Feature requests</option>
                                    <option>Hardware</option>
                                    <option>How to</option>
                                    <option>Network</option>
                                    <option>Password Reset</option>
                                    <option>Software Troubleshooting</option>



                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 px-4">
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Ticket No</th>
                                    <th>Subject</th>
                                    <th>Severity</th>
                                    <th>Status</th>
                                    <th>Category</th>
                                    <th>Created By</th>
                                    <th>Creared On</th>
                                    <th>Accepted By</th>
                                    <th>Accepted On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($rows) : ?>
                                    <?php foreach ($rows as $row) : 
                                        $emp_name_exp = explode(" ", $row->emp_name);
                                        if(sizeof($emp_name_exp) > 1){
                                            $short_name = substr($emp_name_exp[0], 0, 1).substr($emp_name_exp[1], 0, 1);
                                        }else{
                                            $short_name = substr($emp_name_exp[0], 0, 1);
                                        }
                                        ?>
                                    <tr>
                                        <td><?=$row->ticket_number?></td>
                                        <td><?=$row->ticket_subject?></td>
                                        <td><?=$row->ticket_severity_name?></td>
                                        <td><span class="bg-red mx-1 px-1"><?=$row->ticket_status_name?></span></td>
                                        <td><?=$row->ticket_category_name?></td>
                                        <td>
                                            <span>
                                            <div data-toggle="tooltip" data-placement="top" title="<?=$row->emp_name?> <?=$row->email_id?>">
                                            <span class="card-ud" style="padding:4px !important"><?=$short_name?></span><?=$row->email_id?>
                                        </td>
                                        <td><?=date('d-M-Y H:i A', strtotime($row->created_on))?></td>
                                        <td><?=$row->accepted_by_name?></td>
                                        <td><?php if($row->accepted_by_name != ''){ echo date('d-M-Y H:i A', strtotime($row->accepted_at)); }?></td>
                                        <td> <a href="<?=base_url('admin/view-ticket/'.$row->ticket_id)  ?>"><i class="fa fa-eye"></i></a> </td>
                                    </tr>
                                    <?php endforeach ?>
                                <?php endif ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">

                            Distributed By <a class="border-bottom" href="https://sketchmeglobal.com/"
                                target="_blank">SMG</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <?= view('component/js') ?>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script>
    //let table = new DataTable('#myTable');
    </script>

    <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
    </script>

</body>

</html>