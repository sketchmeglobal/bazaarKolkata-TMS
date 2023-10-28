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
                            $last_updated = $rows->last_updated;
                            $max_allowed_time = $rows->max_allowed_time;
                            $deadline = date('Y-m-d H:i:s', strtotime($accepted_at. ' + '.$max_allowed_time.' hours'));
                            //echo 'deadline'. $deadline;
                            
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
                                <div class="col-md-12 mt-4 float-right">
                                    <span id="save_comment_msg"></span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="sticky-this">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" type="button" role="tab" aria-controls="detail" aria-selected="true">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="status-tab" data-bs-toggle="tab" data-bs-target="#status" type="button" role="tab" aria-controls="status" aria-selected="false">Status History</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">                            
                            <!-- Start Details part -->
                            <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
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
                                    <?php if($rows->ticket_status == 7){?>
                                    <div class="d-flex align-items-center py-2">
                                        <p class="mx-3 mb-0">SR Status:</p><span><a href="#">Generated</a></span>
                                    </div>
                                    <?php } ?>
                                    
                                    <?php if($rows->ticket_status == 8){?>
                                    <div class="d-flex align-items-center py-2">
                                        <p class="mx-3 mb-0">Approval: SR Approved</p>
                                    </div>
                                    <?php } ?>

                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <p class="mx-3 mb-0">Ticket Status	</p><span class="bg-red mx-1 px-1" id="ticket_status_2"><?=$rows->ticket_status_name?></span><p class="mb-0 ms-3"></p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <p class="mx-3 mb-0">Ticket Severity:</p><span class="bg-red mx-1 px-1"><?=$rows->ticket_severity_name?></span><p class="mb-0 ms-3"></p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <p class="mx-3 mb-0">Ticket Category</p><span><?=$rows->ticket_category_name?></span><p class="mb-0 ms-3"></p>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <p class="mx-3 mb-0">Last Updated by</p><span><div data-toggle="tooltip" data-placement="top"
                                            title="Admin Demo @admin.demo">
                                            <span class="card-ud" id="accepted_by_short"> <?php if($short_accepted_by_name == ''){ echo "None"; }else{ echo $short_accepted_by_name; }?></span>
                                        </div></span><p class="mb-0 ms-3"></p>
                                    </div>
                                    <div class="d-flex align-items-center py-2">
                                        <p class="mx-3 mb-0">Last Updated: </p><span id="accepted_on"><?php echo date('d-M-Y h:i A', strtotime($last_updated)); ?> </span>
                                    </div>
                                    <?php if($accepted_by > 0 ){?><?php } ?>
                                    <div class="d-flex align-items-center py-2">
                                        <input type="hidden" name="accepted_by" id="accepted_by" value="<?=$accepted_by?>">
                                        <input type="hidden" name="deadline" id="deadline" value="<?=$deadline?>">
                                        <input type="hidden" name="max_allowed_time" id="max_allowed_time" value="<?=$max_allowed_time?>">
                                        <p class="mx-3 mb-0">Time Remaining: </p><span id="countdown"><?=$max_allowed_time?> hrs.</span>
                                    </div>
                                    

                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <p class="mx-3 mb-0">Change Ticket Status </p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center px-2">
                                        <select class="form-control" name="ticket_status_id" id="ticket_status_id">
                                            <?php if ($tic_stat_rows) : ?>
                                                <?php foreach ($tic_stat_rows as $tic_stat_row) : ?>
                                                    <option value="<?=$tic_stat_row->ticket_status_id?>" <?php if($rows->ticket_status == $tic_stat_row->ticket_status_id){?> selected <?php } ?>><?=$tic_stat_row->ticket_status_name?></option>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                        <input type="hidden" name="old_ticket_status_id" id="old_ticket_status_id" value="<?=$rows->ticket_status?>">
                                        <input type="hidden" name="old_ticket_status_text" id="old_ticket_status_text" value="<?=$rows->ticket_status_name?>">
                                    </div>
                                    <div class="d-flex align-items-center px-2 py-2">
                                        <button class="btn btn-primary btn-lg" type="button" id="accept_ticket" data-ticket_id="<?=$rows->ticket_id?>" style="width: 100%;">Update</button>
                                    </div>
                                    <div class="d-flex align-items-center px-2 py-2">
                                        <span id="ticket_stat_msg"> </span>
                                    </div>                                
                                </div>
                            </div>                              
                            <!-- End Details part -->

                            <!-- Start status part -->
                            <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab">
                                <div class="card-body-text" style="background-color: #fff;">
                                    <div class="d-flex align-items-center py-2">
                                        <p class="mx-3 mb-0" >Ticket Number: </p><span><?=$rows->ticket_number?></span>
                                    </div>
                                    <?php
                                    $status_history1 = $rows->status_history;
                                    if($status_history1 != null){
                                        $status_history = json_decode($status_history1);
                                        if(sizeof($status_history) > 0){
                                            for($j = 0; $j < sizeof($status_history); $j++){
                                    ?>
                                    <div class="d-flex align-items-center py-2">
                                        <p class="mx-3 mb-0" style="background-color: #F3F6F9;padding: 15px;font-size: 12px;">Ticket <strong>Status</strong> Updated from <strong><?=$status_history[$j]->old_status_text?></strong> to <strong><?=$status_history[$j]->new_status_text?></strong><br>
                                        <strong>Author: </strong><?=$status_history[$j]->updated_by_name?><br>
                                        <strong>Updated On: </strong> <?=date('d-M-Y h:i A', strtotime($status_history[$j]->updated_on))?>
                                        </p>
                                    </div>
                                    <?php
                                            }
                                        }
                                    }                                    
                                    ?>
                                </div> 
                            </div>  
                            <!-- End status part -->
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
                    //alert(data.message)
                    $('#save_comment_msg').html(data.message);
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
        $ticket_status_id = $('#ticket_status_id').val();
        $max_allowed_time = $('#max_allowed_time').val();
        $ticket_status_text = $('#ticket_status_id option:selected').text();

        $old_ticket_status_id = $('#old_ticket_status_id').val();
        $old_ticket_status_text = $('#old_ticket_status_text').val();

        $.ajax({  
            url: '<?php echo base_url('admin/acceptTicket'); ?>',
            type: 'post',
            dataType:'json',
            data:{ticket_id: $ticket_id, ticket_status_id: $ticket_status_id, ticket_status_text: $ticket_status_text, old_ticket_status_id: $old_ticket_status_id, old_ticket_status_text: $old_ticket_status_text, max_allowed_time: $max_allowed_time},
            success:function(data){
                console.log(JSON.stringify(data));
                console.log('status: ' + data.status);
                if(data.status == true){
                    $('#accepted_by_short').html(initials1);
                    $('#accepted_on').html(data.last_updated);
                    $('#ticket_status_1').html($ticket_status_text);
                    $('#ticket_status_2').html($ticket_status_text);

                    $('#old_ticket_status_id').val($ticket_status_id);
                    $('#old_ticket_status_text').val($ticket_status_text);

                    if(data.deadline != ''){
                        onCountdown(data.deadline);
                    }
                }else{
                    $('#ticket_status_1').html($ticket_status_text);
                    $('#ticket_status_2').html($ticket_status_text);
                    console.log('Ticket Accept problem')                    
                }
                
                $('#ticket_stat_msg').html(data.message);
                //alert(data.message)
            }  
        });
    })

    //countdown timer
    function onCountdown(countDownDate){
        var countDownDate = new Date(countDownDate);
        console.log('countDownDate: ' + countDownDate)
        // Get the current date and time.
        var currentDate = new Date();
        console.log('currentDate: ' + currentDate)
        // Calculate the difference between the two dates.
        if(countDownDate > currentDate){
            var timeRemaining = countDownDate - currentDate;

            // Convert the time to days, hours, minutes, and seconds.
            var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

            // Display the countdown timer.
            document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s";

            // Update the countdown timer every second.
            setInterval(function() {
                console.log('counter...');
                // Get the current date and time.
                var currentDate = new Date();

                // Calculate the difference between the two dates.
                var timeRemaining = countDownDate - currentDate;

                // Convert the time to days, hours, minutes, and seconds.
                var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                // Display the countdown timer.
                document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s";
            }, 1000);
        }
    }//end

    $( document ).ready(function() {
        $accepted_by = $('#accepted_by').val();
        $deadline = $('#deadline').val();
        if($accepted_by > 0){
            onCountdown($deadline);
        }
    });
    </script>

    <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
    </script>

</body>

</html>