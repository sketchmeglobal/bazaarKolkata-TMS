<?= view('component/header') ?>
<!-- < ?= isset($validation) ? print_r($validation) : ''; die; ?> -->

<style>
#s_myFormName .error {
    color: red !important;
    position: relative;
    padding: 0;
}
</style>
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
                    <div class="col-lg-5 col-md-6 col-10 bg-light py-2 text-center border-bottom-all-rd">
                        <h5 class="text-primary">Employee</h5>
                    </div>
                </div>
            </div>
            <div></div>
            <div class="container">
                <div class="row">
                    
                <div class="col-md-12 my-5 px-4">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="ho_id">H.O Name</label>
                                <select class="form-control" id="ho_id" name="ho_id">
                                    <option value="0">Select</option>
                                    <?php if($ho_rows): ?>
                                    <?php foreach($ho_rows as $ho_row): ?>
                                    <option value="<?=$ho_row->id?>"><?=$ho_row->ho_name?> (<?=$ho_row->ho_location?>)</option>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="wh_id">W.H Name</label>
                                <select class="form-control" id="wh_id" name="wh_id">
                                    <option value="0">Select</option>
                                    <?php if($wh_rows): ?>
                                    <?php foreach($wh_rows as $wh_row): ?>
                                    <option value="<?=$wh_row->wh_id?>"><?=$wh_row->wh_name?> (<?=$wh_row->wh_location?>)</option>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="ol_id">Outlet Name</label>
                                <select class="form-control" id="ol_id" name="ol_id">
                                    <option value="0">Select</option>
                                    <?php if($ol_rows): ?>
                                    <?php foreach($ol_rows as $ol_row): ?>
                                    <option value="<?=$ol_row->ol_id?>"><?=$ol_row->ol_name?> (<?=$ol_row->ol_location?>)</option>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="col-lg-3 form-group mt-4">
                                <button type="button" id="filterDept" name="filterDept" class="btn btn-primary ms-2" style="float: left; margin-bottom: 5px;">Search</button>                                
                            </div>
                            <span class="error" id="desigSearchError"></span>

                        </div>
                    </div> 

                    <div class="col-md-12 px-4" id="part_2" style="display: none">
                        <button type="button" id="addNewRecord" class="btn btn-primary ms-2"
                            style="float: right; margin-bottom: 5px;">Add New</button>

                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Employee Name</th>
                                    <th>Primary Phone</th>
                                    <th>Secondary Phone</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal start -->
            <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="text-primary modal-title" id="exampleModalLongTitle">Employee</h5>

                            <button type="button" class=" btn btn-lg btn-primary btn-lg-square back-to-topclose" data-dismiss="modal" aria-label="Close" id="closeModal1"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" id="s_myFormName" method="post">
                                <div class="form-row">
                                    <?php
                                    if (!empty(session()->getFlashdata('success'))) { ?>
                                    <div class="alert alert-success">
                                        <?php echo session()->getFlashdata('success'); ?>
                                    </div>
                                    <?php } ?>
                                    <div class="col-md-11 col-12 mb-2">
                                        <label for="emp_name">Employee Name</label>
                                        <input type="text" class="form-control" name="emp_name" id="emp_name" required value="">
                                        <span class="error" id="emp_nameError"> </span>
                                    </div>
                                    <div class="col-md-11 col-12 mb-2">
                                        <label for="primary_phone">Primary Phone</label>
                                        <input type="number" class="form-control" name="primary_phone"
                                            id="primary_phone" required value="">
                                        <span class="error" id="primary_phoneError"> </span>
                                    </div>
                                    <div class="col-md-11 col-12 mb-2">
                                        <label for="secondary_phone">Secondary Phone</label>
                                        <input type="number" class="form-control" name="secondary_phone"
                                            id="secondary_phone" required value="">
                                        <span class="error" id="secondary_phoneError"> </span>
                                    </div>
                                    <div class="col-md-11 col-12 mb-2">
                                        <label for="email_id">Email ID</label>
                                        <input type="email" class="form-control" name="email_id" id="email_id" required value="">
                                        <span class="error" id="email_idError"> </span>
                                    </div>

                                    <div class="col-md-4 ">
                                        <label for="s_parentDesignation">&nbsp;</label>
                                        <input class="btn btn-primary py-2 w-100 mb-1" type="button" value="Save" name="submit" id="s_submitForm">
                                    </div>
                                </div>
                                <input type="hidden" id="table_id" name="table_id" value="0">
                            </form>

                        </div>
                        <!-- <div class="modal-footer">
                            <div id="formValidMsg" class="invalid-feedback"> </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                id="closeModal">Close</button>
                        </div> -->
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
            //Form Validation    
            //$("#s_myFormName").validate();
            //Validation Form
            function validateForm(){
                $emp_name = $('#emp_name').val().replace(/^\s+|\s+$/gm,'');
                $primary_phone = $('#primary_phone').val().replace(/^\s+|\s+$/gm,'');
                
                $status = true;
                $formValidMsg = '';
                
                if($emp_name == ''){
                    $status = false;
                    $formValidMsg += 'Please enter Employee name';
                    $('#emp_name').removeClass('is-valid');
                    $('#emp_name').addClass('is-invalid');
                }else{
                    $('#emp_name').removeClass('is-invalid');
                    $('#emp_name').addClass('is-valid');
                }

                if($primary_phone == ''){
                    $status = false;
                    $formValidMsg += ', Phone';
                    $('#primary_phone').removeClass('is-valid');
                    $('#primary_phone').addClass('is-invalid');
                }else{
                    $('#primary_phone').removeClass('is-invalid');
                    $('#primary_phone').addClass('is-valid');
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
                        $table_id = $('#table_id').val();                        
                        $ho_id = $('#ho_id').val();
                        $wh_id = $('#wh_id').val();
                        $ol_id = $('#ol_id').val();
                        $secondary_phone = $('#secondary_phone').val();
                        $email_id = $('#email_id').val();
                        
                        $query = {
                            emp_name: $emp_name,
                            primary_phone: $primary_phone,
                            secondary_phone: $secondary_phone,
                            email_id: $email_id,
                            table_id: $table_id,
                            ho_id: $ho_id,
                            wh_id: $wh_id,
                            ol_id: $ol_id                            
                        };

                        console.log('form validated, save data & populate the data table')
                        $.ajax({  
                            url: '<?php echo base_url('admin/formValidationEM'); ?>',
                            type: 'post',
                            dataType:'json',
                            data:{query: $query},
                            success:function(data){
                                console.log(JSON.stringify(data));
                                console.log('status: ' + data.status);
                                if(data.status == true ){
                                    $('#emp_nameError').html('');
                                    $('#primary_phoneError').html('');
                        
                                    $('#formValidMsg').hide();
                                    $("#s_myFormName").trigger("reset");

                                    if(parseInt(data.emp_id) > 0){
                                        //Creat the row
                                        var row = $('<tr>')
                                            .append('<td>'+data.emp_id+'</td>')
                                            .append('<td>'+$emp_name+'</td>')
                                            .append('<td>'+$primary_phone+'</td>')
                                            .append('<td>'+$secondary_phone+'</td>')
                                            .append('<td>'+$email_id+'</td>')
                                            .append('<td class="d-flex justify-content-evenly"><a href="javascript: void(0);" class="edit_class" data-table_id="'+data.emp_id+'"><i class="fa fa-edit"></i></a> <a class="remove" href="javascript: void(0);"><i class="fas fa-times" data-table_id="'+data.emp_id+'"></i></a></td>')

                                        //Prepend row with Table
                                        //myTable.row.add(row);
                                        $('#myTable tbody').prepend(row);
                                    }

                                    //Hide Modal
                                    $('#myModal').modal('hide');
                                }else{
                                    console.log('validation' + JSON.stringify(data.validation));
                                    $validation = data.validation;
                                    for($i in $validation){
                                        console.log($i + '' + $validation[$i])
                                        $('#'+$i+'Error').html($validation[$i])
                                    }
                                }
                            }  
                        });
                    }else{
                        console.log('form validation Error')                    
                        $('#formValidMsg').show();
                    }

                }, 500)    
            })

            //Add Data
            $('#addNewRecord').on('click', function() {
                $("#s_myFormName").trigger("reset");
                $('#table_id').val('0');
                $('#myModal').modal('show');
            })

            //Hide Modal
            $('#closeModal1, #closeModal').on('click', function() {
                $('#myModal').modal('hide');
            })

            //Delete Data
            $(".remove").click(function() {
                if(confirm("Are You Sure? This Process Can\'t be Undone.")){
                    $table_id = $(this).data('table_id');
                    $(this).closest('tr').remove();
                    //console.log('Delete table_id: ' + $table_id);

                    $.ajax({  
                        url: '<?php echo base_url('admin/removeTableDataEM'); ?>',
                        type: 'post',
                        dataType:'json',
                        data:{table_id: $table_id},
                        success:function(data){
                            //console.log(JSON.stringify(data));
                            //console.log('status: ' + data.status);
                            if(data.status == true){
                                //$(this).closest('tr').remove();
                            }
                        }  
                    });//end ajak

                }//end
            });

            //Edit Data
            $(".edit_class").click(function() {
                $table_id = $(this).data('table_id');
                //console.log('Delete table_id: ' + $table_id);

                $.ajax({  
                    url: '<?php echo base_url('admin/getTableDataDG'); ?>',
                    type: 'post',
                    dataType:'json',
                    data:{table_id: $table_id},
                    success:function(data){
                        console.log(JSON.stringify(data));
                        //console.log('status: ' + data.status);
                        if(data.status == true ){
                            $('#emp_name').val(data.result.emp_name);
                            $('#primary_phone').val(data.result.primary_phone);
                            $('#secondary_phone').val(data.result.secondary_phone);
                            $('#email_id').val(data.result.email_id);
                            $('#table_id').val(data.result.emp_id);
                            $('#myModal').modal('show');
                        }
                    }  
                });//end ajak
            });

            
        
            $('#filterDept').on('click', function(){ 
                $ho_id = $('#ho_id').val();
                $wh_id = $('#wh_id').val();
                $ol_id = $('#ol_id').val();
                $counter = 0;
                $('#desigSearchError').html('');

                if(parseInt($ho_id) == 0 && parseInt($wh_id) == 0 && parseInt($ol_id) == 0){
                    $('#desigSearchError').html('Please choose Head Office or Ware House or Outlet');
                }else{
                    if(parseInt($ho_id) > 0){
                        $counter++;
                    }
                    if(parseInt($wh_id) > 0){
                        $counter++;
                    }
                    if(parseInt($ol_id) > 0){
                        $counter++;
                    }
                    console.log('counter: ' + $counter);
                    if(parseInt($counter) > 1){
                        $('#desigSearchError').html('Please choose any one of Head Office or Ware House or Outlet');
                    }else{
                        populateDataTable();
                        $('#part_2').show();
                    }

                }
            })
            
            function populateDataTable(){                
                $ho_id = $('#ho_id').val();
                $wh_id = $('#wh_id').val();
                $ol_id = $('#ol_id').val();

                $('#myTable').dataTable().fnClearTable();
                $('#myTable').dataTable().fnDestroy();
                
                $('#myTable').DataTable( {
                    "processing": true,
                    "language": {
                        processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
                    },
                    "serverSide": true,
                    "ajax": {
                        "url": "<?=base_url('admin/getDesigTableDataEM')?>",
                        "type": "POST",
                        "dataType": "json",
                        data: {
                            ho_id: function () {
                                return $ho_id;
                            },
                            wh_id: function () {
                                return $wh_id;
                            },
                            ol_id: function () {
                                return $ol_id;
                            }
                        },
                    },
                    //will get these values from JSON 'data' variable
                    "columns": [
                        { "data": "slNo" },
                        { "data": "emp_name" },
                        { "data": "primary_phone" },
                        { "data": "secondary_phone" },
                        { "data": "email_id" },
                        { "data": "action" },
                    ],
                    //column initialisation properties
                    "columnDefs": [{
                        "targets": [0, 1, 2, 3],
                        "orderable": false,
                    }]
                });
                
            }//end fun

            </script>