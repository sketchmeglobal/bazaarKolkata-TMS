<?= view('component/header');
$session = session();
?>
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
                    <div class="col-lg-5 col-md-6 col-10 bg-light py-2 text-center border-bottom-all-rd">
                        <h5 class="text-primary">View Ticket</h5>
                    </div>
                </div>
            </div>
            <!-- Ticiekte Start -->
            <?php
            //echo json_encode($rows);
            ?>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4 justify-content-evenly">
                    <div class="col-lg-8 col-md-12">
                        <div class="ticked-head mb-3 overflow-hidden d-flex">
                            <div>
                                <div class=""><span class="text-bg-red px-2 text-light" id="ticket_status_1"><?=$rows->ticket_status_name?></span></div>
                                <div class="mt-2"><i class="fa fa-ticket"></i><span> <?php //echo $rows->ticket_number;?></span></div>
                            </div>
                            <div class="ms-3 pt-2">
                                <h5 class="text-primary"><?=$rows->ticket_subject?></h5>
                                <p><?=$rows->ticket_description?></p>
                                
                                <!-- Attached file from here<p class=""> 
                                    <a href="#"><i class="fa fa-file-image-o"></i> file_example_PNG_500kB.png</a> 
                                </p> -->
                            </div>
                        </div>
                        <ul class="comments-list" id="commentList">
                            <?php
                            function time_elapsed_string($datetime, $full = false) {
                                $now = new DateTime;
                                $ago = new DateTime($datetime);
                                $diff = $now->diff($ago);
                            
                                $diff->w = floor($diff->d / 7);
                                $diff->d -= $diff->w * 7;
                            
                                $string = array(
                                    'y' => 'year',
                                    'm' => 'month',
                                    'w' => 'week',
                                    'd' => 'day',
                                    'h' => 'hour',
                                    'i' => 'minute',
                                    's' => 'second',
                                );
                                foreach ($string as $k => &$v) {
                                    if ($diff->$k) {
                                        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                                    } else {
                                        unset($string[$k]);
                                    }
                                }
                            
                                if (!$full) $string = array_slice($string, 0, 1);
                                return $string ? implode(', ', $string) . ' ago' : 'just now';
                            }

                            $accepted_by = $rows->accepted_by;
                            $accepted_by_name = $rows->accepted_by_name;
                            $accepted_at = $rows->accepted_at;

                            $short_accepted_by_name = '';
                            if($accepted_by_name != ''){
                                $accepted_by_name_exp = explode(" ", $accepted_by_name);
                                if(sizeof($accepted_by_name_exp) > 1){
                                    $short_accepted_by_name = substr($accepted_by_name_exp[0], 0, 1). '' .substr($accepted_by_name_exp[1], 0, 1);
                                }else{
                                    $short_accepted_by_name = substr($accepted_by_name_exp[0], 0, 1);
                                }
                            }//end if

                            $short_created_by_name = '';
                            $created_by_name = $rows->emp_name;
                            if($created_by_name != ''){
                                $created_by_name_exp = explode(" ", $created_by_name);
                                if(sizeof($created_by_name_exp) > 1){
                                    $short_created_by_name = substr($created_by_name_exp[0], 0, 1). '' .substr($created_by_name_exp[1], 0, 1);
                                }else{
                                    $short_created_by_name = substr($created_by_name_exp[0], 0, 1);
                                }
                            }//end if

                            $comment_description1 = $rows->comment_description;
                            if($comment_description1 != null){
                            $comment_description = json_decode($comment_description1);
                                if(sizeof($comment_description) > 0){
                                    for($i = 0; $i < sizeof($comment_description); $i++){
                                        $obj_id = $comment_description[$i]->obj_id;
                                        $reply_text = $comment_description[$i]->reply_text;
                                        $replied_by = $comment_description[$i]->replied_by;
                                        $emp_name = $comment_description[$i]->emp_name;
                                        $email = $comment_description[$i]->email;
                                        $replied_at = $comment_description[$i]->replied_at;

                                        $emp_name_exp = explode(" ", $emp_name);
                                        if(sizeof($emp_name_exp) > 1){
                                            $short_name = substr($emp_name_exp[0], 0, 1). '' .substr($emp_name_exp[1], 0, 1);
                                        }else{
                                            $short_name = substr($emp_name_exp[0], 0, 1);
                                        }

                                        ?>
                                        <li class="position-relative list-style-none mb-3">
                                            <div class="ticket" data-toggle="tooltip" data-placement="top"
                                                title="<?=$emp_name?> <?=$email?>">
                                                <span class=""><?=$short_name?></span>
                                            </div>
                                            <div class="margin-l">
                                                <div class="bg-dark d-flex hd-style py-3 border-top-all-rd">
                                                    <p class="m-0 ms-3 me-3"><a href="#" class="text-light"><?=$email?></a></p>
                                                    <span><?=time_elapsed_string($replied_at)?></span>
                                                </div>
                                                <div class="comment-content py-3 border-bottom-all-rd">
                                                    <p class="ms-3"><?=$reply_text?></p>
                                                    <!-- <p class="ms-3 mb-0">
                                                        <a href="#"><i class="fa fa-file-image-o"></i>
                                                            file_example_PNG_500kB.png</a>
                                                    </p> -->
                                                </div>
                                            </div>
                                        </li>

                                        <?php
                                    }//end for
                                }
                            }
                            ?>
                            <!-- <li class="position-relative list-style-none">
                                <div class="ticket" data-toggle="tooltip" data-placement="top"
                                    title="Admin Demo @admin.demo">
                                    <span class="">AD</span>
                                </div>
                                <div class="margin-l">
                                    <div class="bg-dark d-flex hd-style py-3 border-top-all-rd">
                                        <p class="m-0 ms-3 me-3"><a href="#" class="text-light">@admin.demo</a></p>
                                        <span>2 months ago</span>
                                    </div>
                                    <div class="comment-content py-3 border-bottom-all-rd">
                                        <p class="ms-3">All good. Have changed the mouse.</p>
                                        <p class="ms-3 mb-0">
                                            <a href="#"><i class="fa fa-file-image-o"></i>
                                                file_example_PNG_500kB.png</a>
                                        </p>
                                    </div>
                                </div>

                            </li>
                            <li class="position-relative list-style-none mt-3">
                                <div class="edit-text"><i class="activity-icon fa fa-edit"></i></div>
                                <div class="margin-l">
                                    <a href="#">@user.demo</a><span>Changed status to</span><span
                                        class="bg-red mx-1 px-1">Closed</span><span> 2 months ago</span>
                                </div>
                            </li>
                            <li class="position-relative list-style-none mt-3">
                                <div class="edit-text"><i class="activity-icon fa fa-edit"></i></div>
                                <div class="margin-l">
                                    <a href="#">@user.demo</a><span>Changed status to</span><span
                                        class="bg-green mx-1 px-1">open</span><span> 2 months ago</span>
                                </div>
                            </li>
                            <li class="position-relative list-style-none mt-3">
                                <div class="ticket" data-toggle="tooltip" data-placement="top"
                                    title="User Demo @user.demo">
                                    <span class="">UD</span>
                                </div>
                                <div class="margin-l">
                                    <div class="bg-dark d-flex hd-style py-3 border-top-all-rd">
                                        <p class="m-0 ms-3 me-3"><a href="#" class="text-light">@user.demo</a></p>
                                        <span>2 months ago</span>
                                    </div>
                                    <div class="comment-content py-3 border-bottom-all-rd">
                                        <p class="ms-3 mb-0">Still not working</p>

                                    </div>
                                </div>

                            </li>
                            <li class="position-relative list-style-none mt-3">
                                <div class="edit-text"><i class="activity-icon fa fa-user-plus"></i></div>
                                <div class="margin-l">
                                    <a href="#">@admin.demo</a><span> Changed assignee to </span><span
                                        class="bg-red mx-1 px-1">AD</span><span> 2 months ago</span>
                                </div>
                            </li>
                            <li class="position-relative list-style-none mt-3">
                                <div class="edit-text"><i class="activity-icon fa fa-edit"></i></div>
                                <div class="margin-l">
                                    <a href="#">@user.demo</a><span>Changed status to</span><span
                                        class="bg-red mx-1 px-1">Closed</span><span> 2 months ago</span>
                                </div>
                            </li>
                            <li class="position-relative list-style-none mt-3">
                                <div class="edit-text"><i class="activity-icon fa fa-edit"></i></div>
                                <div class="margin-l">
                                    <a href="#">@user.demo</a><span>Changed status to</span><span
                                        class="bg-red mx-1 px-1">Closed</span><span> 2 months ago</span>
                                </div>
                            </li> -->

                        </ul>
                        <div class="mt-5">
                            <div><h3>Leave a comment</h3></div>
                            <form action="" name="s_myFormName" id="s_myFormName">
                                <textarea name="reply_text" id="reply_text" class="col-lg-12 col-md-12" ></textarea>
                                <div class="custom-file mt-4">
                                    <input id="fileInput" type="file" class="custom-file-input">                                    
                                </div>
                                <div class="col-md-12 mt-4 float-right">
                                    <button class="btn btn-primary" type="button" id="s_submitForm" data-ticket_id="<?=$rows->ticket_id?>">Reply <i class="fa fa-reply"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="sticky-this">
                        <div class="card-header text-center"><h5 class="text-primary">Details</h5></div>
                        <div class="card-body-text">
                            <div class="d-flex align-items-center py-2">
                                <p class="mx-3 mb-0">Ticket Number: </p><span><?=$rows->ticket_number?></span>
                            </div>
                            <div class="d-flex align-items-center py-2">
                                <p class="mx-3 mb-0">Created By</p><span><div data-toggle="tooltip" data-placement="top"
                                    title="<?=$rows->emp_name?> <?=$rows->email_id?>">
                                    <span class="card-ud" ><?=$short_created_by_name?></span>
                                </div></span>
                            </div>
                            <div class="d-flex align-items-center py-2">
                                <p class="mx-3 mb-0">Created on: </p><span><?=date('d-M-Y H:i A', strtotime($rows->created_on))?></span>
                            </div>
                            <div class="d-flex align-items-center py-2">
                                <p class="mx-3 mb-0">Purpose:</p><span><?=$rows->ticket_purpose?></span>
                            </div>
                            <div class="d-flex align-items-center py-2">
                                <p class="mx-3 mb-0">SR Status:</p><span><a href="#">Generated (SR/WB0O2C/001)</a></span>
                            </div>
                            <div class="d-flex align-items-center py-2">
                                <p class="mx-3 mb-0">Approval: Pending </p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-2">
                                <p class="mx-3 mb-0">Ticket Status	</p><span class="bg-red mx-1 px-1" id="ticket_status_2"><?=$rows->ticket_status_name?></span><p class="mb-0 ms-3"><!--<a href="#">edit</a>--></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center py-2">
                                <p class="mx-3 mb-0">Ticket Severity:</p><span class="bg-red mx-1 px-1"><?=$rows->ticket_severity_name?></span><p class="mb-0 ms-3"><!--<a href="#">edit</a>--></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center py-2">
                                <p class="mx-3 mb-0">Ticket Category</p><span><?=$rows->ticket_category_name?></span><p class="mb-0 ms-3"><!--<a href="#">edit</a>--></p>
                            </div>
                            <!-- <div class="d-flex justify-content-between align-items-center py-2">
                                <p class="mx-3 mb-0">Ticket Priority</p><span>-</span><p class="mb-0 ms-3"><a href="#">edit</a></p>
                            </div> -->
                            <div class="d-flex justify-content-between align-items-center py-2">
                                <p class="mx-3 mb-0">Accepted by</p><span><div data-toggle="tooltip" data-placement="top"
                                    title="Admin Demo @admin.demo">
                                    <span class="card-ud" id="accepted_by_short"> <?php if($short_accepted_by_name == ''){ echo "None"; }else{ echo $short_accepted_by_name; }?></span>
                                </div></span><p class="mb-0 ms-3"></p>
                            </div>
                            <div class="d-flex align-items-center py-2">
                                <p class="mx-3 mb-0">Accepted on	</p><span id="accepted_on"><?php if($accepted_by > 0){ echo $accepted_at; }else{ echo "xx-xx-xxxx xx:xx x"; } ?> </span>
                            </div>
                            <!-- <div class="d-flex align-items-center py-2">
                                <p class="mx-3 mb-0">Last Updated on</p><span>-</span>
                            </div> -->

                            <!-- /accepted_by -->
                            <div class="d-flex align-items-center py-2">
                                <button class="btn btn-primary btn-lg <?php if($accepted_by > 0){?>disabled<?php } ?>" type="button" id="accept_ticket" data-ticket_id="<?=$rows->ticket_id?>" style="width: 100%;"><?php if($accepted_by > 0){?>Accepted<?php }else{?> Accept <?php } ?> </button>
                            </div>
                            
                        </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- Ticiekte End -->


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
    
    /*var x = "<?= $rows->emp_name?>";
    var nameparts = x.split(" ");
    if(nameparts.length > 1){
        var initials = nameparts[0].charAt(0).toUpperCase() + nameparts[1].charAt(0).toUpperCase(); //Output: SR
    }else{
        var initials = nameparts[0].charAt(0).toUpperCase();
    }
    $('#emp_short_name').html(initials);*/

    var emp_name = "<?=$session->emp_name?>";
    var email = "<?=$session->email?>";
    var nameparts1 = emp_name.split(" ");
    if(nameparts1.length > 1){
        var initials1 = nameparts1[0].charAt(0).toUpperCase() + nameparts1[1].charAt(0).toUpperCase(); //Output: SR
    }else{
        var initials1 = nameparts1[0].charAt(0).toUpperCase();
    }

    //Submit Form
    $('#s_submitForm').click(function(){
        $ticket_id = $(this).data('ticket_id');
        console.log('ticket_id: ' + $ticket_id)
        $reply_text = $('#reply_text').val();
        

        if($reply_text == ''){ 
            alert('Please write your reply');
        }else{            
            $.ajax({  
                url: '<?php echo base_url('admin/formValidationTICR'); ?>',
                type: 'post',
                dataType:'json',
                data:{ticket_id: $ticket_id, reply_text: $reply_text},
                success:function(data){
                    console.log(JSON.stringify(data));
                    console.log('status: ' + data.status);
                    alert(data.message)
                    if(data.status == true ){
                        $('#s_myFormName')[0].reset(); 

                        // Get the ul element
                        var ul = $("#commentList");

                        // Create a new li element
                        var li = $("<li class='position-relative list-style-none'> <div class='ticket' data-toggle='tooltip' data-placement='top' title='"+emp_name+" "+email+"'> <span class=''>"+initials1+"</span> </div> <div class='margin-l'> <div class='bg-dark d-flex hd-style py-3 border-top-all-rd'> <p class='m-0 ms-3 me-3'><a href='#' class='text-light'>"+email+"</a></p> <span>Just Now</span> </div> <div class='comment-content py-3 border-bottom-all-rd'> <p class='ms-3'>"+$reply_text+"</p> <p class='ms-3 mb-0'> </p> </div> </div> </li>");

                        // Append the li element to the ul element
                        ul.append(li);
                    }else{
                        console.log('validation' + JSON.stringify(data.validation));
                        $validation = data.validation;
                    }
                }  
            });
        }//end if 
    })

    //Accept ticket
    $('#accept_ticket').on('click', function(){
        // Select the button you want to disable.  
        $ticket_id = $(this).data('ticket_id');

        $.ajax({  
            url: '<?php echo base_url('admin/acceptTicket'); ?>',
            type: 'post',
            dataType:'json',
            data:{ticket_id: $ticket_id},
            success:function(data){
                console.log(JSON.stringify(data));
                console.log('status: ' + data.status);
                alert(data.message)
                if(data.status == true ){
                    $('#accepted_by_short').html(initials1);
                    $('#accepted_on').html('just now');
                    $('#ticket_status_1').html('In-progress');
                    $('#ticket_status_2').html('In-progress');
                    $('#accept_ticket').html('Accepted');
                    $('#accept_ticket').prop('disabled', true); 
                }else{
                    console.log('Ticket Accept problem')                    
                }
            }  
        });
    })
    </script>

    <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
    </script>

</body>

</html>