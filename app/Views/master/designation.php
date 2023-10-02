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
                        <h5 class="text-primary">Designation</h5>
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
                        <button type="button" id="addNewRecord" class="btn btn-primary ms-2"
                            style="float: right; margin-bottom: 5px;">Add New</button>

                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Designation Name</th>
                                    <th>Designation Priority</th>
                                    <th>Acction</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($rows) : ?>
                                <?php foreach ($rows as $row) : ?>
                                <tr>
                                    <td><?=$row['dg_id']?></td>
                                    <td><?=$row['desig_name']?></td>
                                    <td><?=$row['desig_priority']?></td>
                                    <td class="d-flex justify-content-evenly">
                                        <a href="javascript: void(0);" class="edit_class" data-table_id="<?=$row['dg_id']?>"><i class="fa fa-edit"></i></a>
                                        <a class="remove" href="javascript: void(0);" data-table_id="<?=$row['dg_id']?>"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                                <?php endif ?>

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
                            <h5 class="text-primary modal-title" id="exampleModalLongTitle">Designation</h5>

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
                                        <label for="desig_name">Designation Name</label>
                                        <input type="text" class="form-control" name="desig_name" id="desig_name" required value="">
                                        <span class="error" id="desig_nameError"> </span>


                                    </div>
                                    <div class="col-md-11 col-12 mb-2">
                                        <label for="desig_priority">Designation Priority</label>
                                        <input minlength="1" type="number" class="form-control" name="desig_priority"
                                            id="desig_priority" required value="">
                                        <span class="error" id="desig_priorityError"> </span>
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
                $desig_name = $('#desig_name').val().replace(/^\s+|\s+$/gm,'');
                $desig_priority = $('#desig_priority').val().replace(/^\s+|\s+$/gm,'');
                
                $status = true;
                $formValidMsg = '';
                
                if($desig_name == ''){
                    $status = false;
                    $formValidMsg += 'Please enter Designation name';
                    $('#desig_name').removeClass('is-valid');
                    $('#desig_name').addClass('is-invalid');
                }else{
                    $('#desig_name').removeClass('is-invalid');
                    $('#desig_name').addClass('is-valid');
                }

                if($desig_priority == ''){
                    $status = false;
                    $formValidMsg += ', priority';
                    $('#desig_priority').removeClass('is-valid');
                    $('#desig_priority').addClass('is-invalid');
                }else{
                    $('#desig_priority').removeClass('is-invalid');
                    $('#desig_priority').addClass('is-valid');
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
                        $query = {
                            desig_name: $desig_name,
                            desig_priority: $desig_priority,
                            table_id: $table_id
                        };

                        console.log('form validated, save data & populate the data table')
                        $.ajax({  
                            url: '<?php echo base_url('admin/formValidationDG'); ?>',
                            type: 'post',
                            dataType:'json',
                            data:{query: $query},
                            success:function(data){
                                console.log(JSON.stringify(data));
                                console.log('status: ' + data.status);
                                if(data.status == true ){
                                    $('#desig_nameError').html('');
                                    $('#desig_priorityError').html('');
                        
                                    $('#formValidMsg').hide();
                                    $("#s_myFormName").trigger("reset");

                                    if(parseInt(data.ho_id) > 0){
                                        //Creat the row
                                        var row = $('<tr>')
                                            .append('<td>'+data.ho_id+'</td>')
                                            .append('<td>'+$desig_name+'</td>')
                                            .append('<td>'+$desig_priority+'</td>')
                                            .append('<td class="d-flex justify-content-evenly"><a href="javascript: void(0);" class="edit_class" data-table_id="'+data.ho_id+'"><i class="fa fa-edit"></i></a> <a class="remove" href="javascript: void(0);"><i class="fas fa-times" data-table_id="'+data.ho_id+'"></i></a></td>')

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
                        url: '<?php echo base_url('admin/removeTableDataDG'); ?>',
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
                            $('#desig_name').val(data.result.desig_name);
                            $('#desig_priority').val(data.result.desig_priority);
                            $('#table_id').val(data.result.dg_id);
                            $('#myModal').modal('show');
                        }
                    }  
                });//end ajak
            });

            
        
            $('#filterDept').on('click', function(){ 
                $('#part_2').show();
            })
            </script>