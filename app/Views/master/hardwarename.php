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
                        <h5 class="text-primary">Hardware Name</h5>
                    </div>
                </div>
            </div>
            <div></div>
            <div class="container">
                <div class="row">
                    <!-- <div class="col-md-12 my-5 px-4">
                        <div class="row">
                            <div class=" col-md-3 form-group">
                                <label class="control-label alpaca-control-label" for="alpaca3">Assigned To</label>
                                <input type="text" id="alpaca3" name="assign_to" class="alpaca-control form-control" autocomplete="off">
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
                    </div> -->
                    <div class="col-md-12 px-4">
                        <button type="button" id="addNewRecord" class="btn btn-primary ms-2" style="float: right; margin-bottom: 5px;">Add New</button>

                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Head Office Name</th>
                                    <th>Head Office Location</th>
                                    <th>Acction</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1 </td>
                                    <td>Baazar Kolkata</td>
                                    <td>Network</td>
                                    <td class="d-flex justify-content-evenly">
                                        <a href="#" class="edit_class" data-table_id="1"><i class="fa fa-edit"></i></a>
                                        <a class="remove" href="#"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Baazar Kolkata</td>
                                    <td>Maidan</td>
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
                                            <label for="headofficeName">Head office Name</label>
                                            <input type="text" class="form-control" name="headofficeName" id="headofficeName" value="" > 
                                        </div>  
                                        <div class="col-md-4 mb-1">
                                            <label for="headofficeLocation">Head office Location</label>
                                            <input type="text" class="form-control" name="headofficeLocation" id="headofficeLocation" value="" > 
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
            $headofficeName = $('#headofficeName').val().replace(/^\s+|\s+$/gm,'');
            $headofficeLocation = $('#headofficeLocation').val().replace(/^\s+|\s+$/gm,'');
            
            $status = true;
            $formValidMsg = '';
            
            if($headofficeName == ''){
                $status = false;
                $formValidMsg += 'Please enter Head office name';
                $('#headofficeName').removeClass('is-valid');
                $('#headofficeName').addClass('is-invalid');
            }else{
                $('#headofficeName').removeClass('is-invalid');
                $('#headofficeName').addClass('is-valid');
            }

            if($headofficeLocation == ''){
                $status = false;
                $formValidMsg += ', location';
                $('#headofficeLocation').removeClass('is-valid');
                $('#headofficeLocation').addClass('is-invalid');
            }else{
                $('#headofficeLocation').removeClass('is-invalid');
                $('#headofficeLocation').addClass('is-valid');
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
                        .append('<td>Headoffice Bagnan</td>')
                        .append('<td>Bagnan</td>')
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
            $('#headofficeName').val('Baazar Kolkata');
            $('#headofficeLocation').val('Newtown');
            $('#myModal').modal('show');
            
        })

    </script>
    