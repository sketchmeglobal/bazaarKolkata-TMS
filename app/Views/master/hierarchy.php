<?= view('component/header') ?>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                    <div class="col-lg-5 col-md-6 col-10 bg-light py-2 text-center border-bottom-all-rd">
                        <h5 class="text-primary">Hierarchy</h5>
                    </div>
                </div>
            </div>
            <div></div>
            <div class="container">
                <div class="row">
                     <div class="col-md-12 my-5 px-4">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="departmentName">H.O Name</label>
                                <select class="form-control" id="departmentName" name="departmentName">
                                    <option value="0">Select</option>
                                    <option value="1">Head Office Kolkata</option>
                                    <option value="2">Head Office Bangalore</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="wareHouseName">W.H Name</label>
                                <select class="form-control" id="wareHouseName" name="wareHouseName">
                                    <option value="0">Select</option>
                                    <option value="1">Ware House Kolkata</option>
                                    <option value="2">Ware House Bangalore</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="outletName">Outlet Name</label>
                                <select class="form-control" id="outletName" name="outletName">
                                    <option value="0">Select</option>
                                    <option value="1">Outlet Kolkata</option>
                                    <option value="2">Outlet Bangalore</option>
                                </select>
                            </div>
                            <div class="col-lg-3 form-group mt-4">
                                <button type="button" id="filterDept" name="filterDept" class="btn btn-primary ms-2" style="float: left; margin-bottom: 5px;">Search</button>                                
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-12 px-4" id="part_2" style="display: none">
                        <button type="button" id="addNewRecord" class="btn btn-primary ms-2" style="float: right; margin-bottom: 5px;">Add New</button>

                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Department Name</th>
                                    <th>Priority</th>
                                    <th>Acction</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1 </td>
                                    <td>Human Resource management</td>
                                    <td>1</td>
                                    <td class="d-flex justify-content-evenly">
                                        <a href="#" class="edit_class" data-table_id="1"><i class="fa fa-edit"></i></a>
                                        <a class="remove" href="#"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Customer Relationship Management</td>
                                    <td>2</td>
                                    <td class="d-flex justify-content-evenly">
                                        <a href="#" class="edit_class" data-table_id="2"><i class="fa fa-edit"></i></a>
                                        <a class="remove" href="#"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

                <!-- Modal start -->
                <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"> Add/Edit Head office name</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal1"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate name="s_myFormName" id="s_myFormName">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-1">
                                            <label for="departmentName">Department Name</label>
                                            <select class="form-control" id="departmentName" name="departmentName">
                                                <option value="0">Select</option>
                                                <option value="1">Human Resource management</option>
                                                <option value="2">Customer Relationship Management</option>
                                            </select>
                                        </div>  
                                        <div class="col-md-4 mb-1">
                                            <label for="deptPriority">Priority</label>
                                            <input type="number" class="form-control" name="deptPriority" id="deptPriority" value="" > 
                                        </div>                              
                                        
                                        <div class="col-md-4 pt-4">
                                        <label for="s_parentDesignation">&nbsp;</label>
                                            <button class="btn  btn-primary" type="button" id="s_submitForm">
                                                <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="s_submitForm_spinner"></span>
                                                <span class="load-text" style="display: none;" id="s_submitForm_spinner_text">Loading...</span>
                                                <span class="btn-text" id="s_submitForm_text">Save</span>
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" id="table_id" name="table_id" value="">
                                </form>
                                
                            </div>
                            <div class="modal-footer">   
                                <div id="formValidMsg" class="invalid-feedback"> </div>                         
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Modal end -->

            <!-- Footer Start -->
            <?= view('component/footer') ?>
            <!-- Footer End -->
    <!-- JavaScript Libraries -->

    <?= view('component/js') ?>
    <script>
        $(".remove").click(function() {
            $(this).closest('tr').remove();
        });

        //Show Modal
        $('#addNewRecord').on('click', function(){
            $("#s_myFormName").trigger("reset");
            $('#myModal').modal('show');
        })
        $('#closeModal1, #closeModal').on('click', function(){
            $('#myModal').modal('hide');
        })

        
        //Validation Form
        function validateForm(){
            $departmentName = $('#departmentName').val().replace(/^\s+|\s+$/gm,'');
            $deptPriority = $('#deptPriority').val().replace(/^\s+|\s+$/gm,'');
            
            $status = true;
            $formValidMsg = '';
            
            if($departmentName == ''){
                $status = false;
                $formValidMsg += 'Please select Department name';
                $('#departmentName').removeClass('is-valid');
                $('#departmentName').addClass('is-invalid');
            }else{
                $('#departmentName').removeClass('is-invalid');
                $('#departmentName').addClass('is-valid');
            }

            if($deptPriority == ''){
                $status = false;
                $formValidMsg += ', enter priority number';
                $('#deptPriority').removeClass('is-valid');
                $('#deptPriority').addClass('is-invalid');
            }else{
                $('#deptPriority').removeClass('is-invalid');
                $('#deptPriority').addClass('is-valid');
            } 

            $('#formValidMsg').html($formValidMsg);

            $('#s_submitForm_spinner').hide();
            $('#s_submitForm_spinner_text').hide();
            $('#s_submitForm_text').show();

            return $status;
        }//en validate form

        //Submit Form
        $('#s_submitForm').click(function(){
            $('#s_submitForm_spinner').show();
            $('#s_submitForm_spinner_text').show();
            $('#s_submitForm_text').hide();
            $('#formValidMsg').hide();

            setTimeout(function(){
                $formVallidStatus = validateForm();

                if($formVallidStatus == true){
                    console.log('form validated, save data & populate the data table')
                    $('#formValidMsg').hide();
                    $("#s_myFormName").trigger("reset");

                    //Creat the row
                    var row = $('<tr>')
                        .append('<td>#</td>')
                        .append('<td>Dept 1</td>')
                        .append('<td>0</td>')
                        .append('<td class="d-flex justify-content-evenly"><a href="#" class="edit_class" data-table_id="3"><i class="fa fa-edit"></i></a> <a class="remove" href="#"><i class="fas fa-times"></i></a></td>')

                    //Prepend row with Table
                    //myTable.row.add(row);
                    $('#myTable tbody').prepend(row);

                    //Hide Modal
                    $('#myModal').modal('hide');
                }else{
                    console.log('form validation Error')                    
                    $('#formValidMsg').show();
                }

            }, 500)    
        })

        //Edit Function
        $('#myTable').on('click', '.edit_class', function(){ 
            $table_id = $(this).data('table_id');
            $('#table_id').val($table_id);
            $('#departmentName').val('Baazar Kolkata');
            $('#deptPriority').val('Newtown');
            $('#myModal').modal('show');            
        })
        
        $('#filterDept').on('click', function(){ 
            $('#part_2').show();
        })

    </script>
    