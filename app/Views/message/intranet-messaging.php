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
                    <div class="container-fluid">
                      <nav aria-label="breadcrumb" class="row bg-breadcrumb">
                        <ol class="breadcrumb my-0 ms-2">
                          <li class="breadcrumb-item">
                            <span>Home</span>
                          </li>
                          <li class="breadcrumb-item active"><span>Intra Messaging</span></li>
                        </ol>
                      </nav>
                    </div>
                </div>
            </div>
            <div></div>
            <div class="container">
                <div class="row bg-light">

                    <!-- Send Message box -->
                    <div class="col-md-12 my-2 px-4">
                        <form class="needs-validation" novalidate name="s_myFormName" id="s_myFormName">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea name="message" id="message" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4 col-12 ">
                                    <div class="form-group">
                                        <label for="end_date">End date</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" >
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <div class="col-md-12 mt-4 float-right">
                                            <button class="btn btn-primary" type="button" id="s_submitForm" >Send <i class="fa fa-reply"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <span class="col-md-12 mt-4 float-left" id="formValidMsg" style="color: #f00;"></apan>

                            </div>
                        </form>
                    </div>
                    <!-- Send Message box -->

                    <div class="col-md-12 px-4" id="part_2" >
                        <!-- <button type="button" id="addNewRecord" class="btn btn-primary ms-2"
                            style="float: right; margin-bottom: 5px;">Add New</button> -->

                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>From</th>
                                    <th>Message</th>
                                    <th>Sent date</th>
                                    <th>End date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($rows) : ?>
                                <?php 
                                    $i = 1;
                                    foreach ($rows as $row) : ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=$row->emp_name?></td>
                                    <td><?=$row->message?></td>
                                    <td><?=date('d-M-Y', strtotime($row->sent_date))?></td>
                                    <td><?=date('d-M-Y', strtotime($row->end_date))?></td>
                                </tr>
                                <?php 
                                $i++;
                                endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            

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
                $message = $('#message').val().replace(/^\s+|\s+$/gm,'');
                $end_date = $('#end_date').val().replace(/^\s+|\s+$/gm,'');
                
                $status = true;
                $formValidMsg = '';
                
                if($message == ''){
                    $status = false;
                    $formValidMsg += 'Please write message';
                    $('#message').removeClass('is-valid');
                    $('#message').addClass('is-invalid');
                }else{
                    $('#message').removeClass('is-invalid');
                    $('#message').addClass('is-valid');
                }

                if($end_date == ''){
                    $status = false;
                    $formValidMsg += ', and select end date';
                    $('#end_date').removeClass('is-valid');
                    $('#end_date').addClass('is-invalid');
                }else{
                    $('#end_date').removeClass('is-invalid');
                    $('#end_date').addClass('is-valid');
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
                        
                        $query = {
                            message: $message,
                            end_date: $end_date
                        };

                        console.log('form validated, save data & populate the data table')
                        $.ajax({  
                            url: '<?php echo base_url('admin/formValidationIM'); ?>',
                            type: 'post',
                            dataType:'json',
                            data:{query: $query},
                            success:function(data){
                                console.log(JSON.stringify(data));
                                console.log('status: ' + data.status);
                                if(data.status == true ){
                                    $('#messageError').html('');
                                    $('#end_dateError').html('');
                        
                                    $('#formValidMsg').hide();
                                    $("#s_myFormName").trigger("reset");

                                    if(parseInt(data.im_id) > 0){
                                        //Creat the row
                                        var row = $('<tr>')
                                            .append('<td>1</td>')
                                            .append('<td>'+$message+'</td>')
                                            .append('<td>'+$end_date+'</td>')
                                            .append('<td class="d-flex justify-content-evenly"><a href="javascript: void(0);" class="edit_class" ><i class="fa fa-edit"></i></a> <a class="remove" href="javascript: void(0);"><i class="fas fa-times" ></i></a></td>')

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
                $('#myModal').modal('show');
            })

            //Hide Modal
            $('#closeModal1, #closeModal').on('click', function() {
                $('#myModal').modal('hide');
            })

            //Delete Data
            $('#myTable').on('click', '.remove', function(){
                if(confirm("Are You Sure? This Process Can\'t be Undone.")){
                    $(this).closest('tr').remove();

                    $.ajax({  
                        url: '<?php echo base_url('admin/removeTableDataDG'); ?>',
                        type: 'post',
                        dataType:'json',
                        data:{table_id: '0'},
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
            $('#myTable').on('click', '.edit_class', function(){
                $table_id = '0';//$(this).data('table_id');
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
                            $('#message').val(data.result.message);
                            $('#end_date').val(data.result.end_date);
                            //$('#table_id').val(data.result.im_id);
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
                        "url": "<?=base_url('admin/getDesigTableData')?>",
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
                        { "data": "desigName" },
                        { "data": "desigPriority" },
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