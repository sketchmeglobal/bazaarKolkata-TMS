<?php

namespace App\Models;

use CodeIgniter\Model;

class SummaryreportM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ticket_details';
    protected $primaryKey       = 'ticket_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ticket_id','topic_id', 'topic_name', 'ticket_subject', 'ticket_category', 'ticket_category_name', 'ticket_severity', 'ticket_severity_name', 'authority_cc', 'ticket_purpose', 'ticket_description', 'ticket_status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getTicketDetails($ticket_id){
      $hw_rows = $this->db->table('ticket_details')->select('ticket_details.ticket_id, ticket_details.ticket_number, ticket_details.topic_id, ticket_details.ticket_subject, ticket_details.ticket_category, ticket_details.ticket_severity, ticket_details.ticket_category, ticket_details.authority_cc, ticket_details.ticket_purpose, ticket_details.ticket_description, ticket_details.created_by, ticket_details.ticket_status, ticket_details.created_on, ticket_severity_master.ticket_severity_name, ticket_severity_master.max_allowed_time, ticket_category_master.ticket_category_name, ticket_status_master.ticket_status_name, employee.emp_name, employee.email_id, ticket_comments.comment_description, ticket_comments.status_history, ticket_comments.accepted_by, ticket_comments.accepted_by_name, ticket_comments.accepted_at, ticket_comments.last_updated')->join('ticket_severity_master', 'ticket_severity_master.ticket_severity_id = ticket_details.ticket_severity')->join('ticket_category_master', 'ticket_category_master.ticket_category_id = ticket_details.ticket_category')->join('ticket_status_master', 'ticket_status_master.ticket_status_id = ticket_details.ticket_status')->join('employee', 'employee.emp_id = ticket_details.created_by')->join('ticket_comments', 'ticket_comments.ticket_id = ticket_details.ticket_id')->where(['ticket_details.ticket_id' => $ticket_id])->get()->getResult();
      //echo $this->db->getLastQuery();
      //die;

      return $hw_rows[0];
    }//end function  

    public function insertTableData($validatedData){
      $status = true;
      $return_data = array();
      $ticket_comment_id = 0;
      $comment_description = array();
      $message = '';
      
      $ticket_id = $validatedData['ticket_id'];
      $reply_text = $validatedData['reply_text'];
      $replied_by = $validatedData['replied_by'];
      $emp_name = $validatedData['emp_name'];
      $email = $validatedData['email'];

      
      $comment_description_obj = new \stdClass;
      $comment_description_obj->obj_id = rand(1000, 9999);
      $comment_description_obj->reply_text = $reply_text; 
      $comment_description_obj->replied_by = $replied_by; 
      $comment_description_obj->emp_name = $emp_name; 
      $comment_description_obj->email = $email; 
      $comment_description_obj->replied_at = date('d-m-Y H:i:s'); 

      //duplicate checking
      $row = $this->db->table('ticket_comments')->select('*')->where(['ticket_id' => $ticket_id])->get()->getResult();

      $arr_size = sizeof($row);
      if($arr_size > 0){
        $comment_description1 = $row[0]->comment_description;
        $comment_description = json_decode($comment_description1);
        array_push($comment_description, $comment_description_obj);

        $update_array = [
          'comment_description' => json_encode($comment_description)
        ];
        //update query
        $this->db->table('ticket_comments')->update($update_array, ['ticket_id' => $ticket_id]);
        $status = true;          
        $message = 'Reply saved successfully';

      }else{
        //insert query
        array_push($comment_description, $comment_description_obj);
        $insert_array = [
          'ticket_id' => $ticket_id,
          'comment_description' => json_encode($comment_description)
        ];

        $this->db->table('ticket_comments')->insert($insert_array);
        $ticket_comment_id = $this->db->insertID();
        if($ticket_comment_id > 0){
          $status = true;          
        }else{
          $status = false;
          $message = 'Insert Query Problem';
        }
      }//end if

      $return_data['ticket_comment_id'] = $ticket_comment_id;
      $return_data['status'] = $status;
      $return_data['message'] = $message;
      return $return_data;
    }

    public function removeTableDataEM($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('ticket_details')->where('ticket_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataHIS($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('ticket_details')->select('*')->where(['row_status' => 1, 'ticket_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function
    

    public function getDeviceSerialonHIS($hw_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('hardware_serial')->select('*')->where(['row_status' => 1, 'hw_id' => $hw_id])->get()->getResult();

      $option_text = '<option value="0">Select</option>';
      for($i = 0; $i < sizeof($row); $i++){
        $option_text .= '<option value="'.$row[$i]->hw_sl_id.'">'.$row[$i]->serial_no.'</option>';
      }//end for

      $return_data['status'] = $status;
      $return_data['option_text'] = $option_text;

      return $return_data;
    }//end function


    public function getDesigTableDataEM(){
      $request = \Config\Services::request();
      $ho_id = $request->getPost('ho_id');      
      $wh_id = $request->getPost('wh_id');     
      $ol_id = $request->getPost('ol_id');

      $data = array();
      $particulars = array();
      $invoice_details = array();
      $inv_paymentHistory = array();

      $result = $this->db->table('ticket_details')->select('*')->where(['ho_id' => $ho_id, 'wh_id' => $wh_id, 'ol_id' => $ol_id, 'row_status' => 1 ])->get()->getResult();

      //echo json_encode($result);

      $counter = 1;
      if(count($result) > 0){
        for($i = 0; $i < sizeof($result); $i++){
          $nestedData['slNo'] = $counter;
          $nestedData['ticket_id'] = $result[$i]->ticket_id;
          $nestedData['primary_phone'] = $result[$i]->primary_phone;
          $nestedData['secondary_phone'] = $result[$i]->secondary_phone;
          $nestedData['email_id'] = $result[$i]->email_id;
          $nestedData['action'] = '<td class="d-flex justify-content-evenly"><a href="javascript: void(0);" class="edit_class" data-table_id="'.$result[$i]->ticket_id.'"><i class="fa fa-edit"></i></a> <a class="remove" href="javascript: void(0);"><i class="fas fa-times" data-table_id="'.$result[$i]->ticket_id.'"></i></a></td>';

          $counter++;
          array_push($data, $nestedData);
        }
      }
      $json_data = array(
          "recordsTotal"    => sizeof($data),
          "recordsFiltered" => sizeof($data),
          "data"            => $data
      );       
      
      return $json_data;
    }//end function    

    public function getHwSerialNo($hw_id){
      $status = true;
      $return_data = array();      

      $row = $this->db->table('hardware_serial')->select('*')->where(['row_status' => 1, 'hw_id' => $hw_id ])->get()->getResult();

      $option_text = '<option value="0">Select</option>';
      for($i = 0; $i < sizeof($row); $i++){
        $option_text .= '<option value="'.$row[$i]->hw_sl_id.'">'.$row[$i]->serial_no.'</option>';
      }//end for

      $return_data['status'] = $status;
      $return_data['option_text'] = $option_text;

      return $return_data;
    }//end function  

    public function removeTableDataHIS($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('ticket_details')->where('ticket_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function  

    public function acceptTicket($post_data){
      //setting the timezone
      $tz = 'Asia/Kolkata';   
      date_default_timezone_set($tz);
            
      $status = true;
      $message = '';
      $deadline = '';
      $return_data = array();

      $ticket_id = $post_data['ticket_id'];

      $ticket_status_id = $post_data['ticket_status_id'];
      $ticket_status_text = $post_data['ticket_status_text'];

      $old_ticket_status_id = $post_data['old_ticket_status_id'];
      $old_ticket_status_text = $post_data['old_ticket_status_text'];
      $max_allowed_time = $post_data['max_allowed_time'];

      $accepted_by = $post_data['accepted_by'];
      $accepted_by_name = $post_data['accepted_by_name'];
      $accepted_at = date('Y-m-d H:i:s');

      $row = $this->db->table('ticket_comments')->select('*')->where(['ticket_id' => $ticket_id])->get()->getResult();
      $accepted_by_pro = $row[0]->accepted_by;
      $accepted_by_name_pro = $row[0]->accepted_by_name;
      $status_history1 = $row[0]->status_history;
      $status_history = json_decode($status_history1);

      $status_history_obj = new \stdClass();
      $status_history_obj->obj_id = rand(10000, 99999);
      $status_history_obj->updated_by = $accepted_by;
      $status_history_obj->updated_by_name = $accepted_by_name;
      $status_history_obj->old_status = $old_ticket_status_id;
      $status_history_obj->old_status_text = $old_ticket_status_text;
      $status_history_obj->new_status = $ticket_status_id;
      $status_history_obj->new_status_text = $ticket_status_text;
      $status_history_obj->updated_on = date('d-m-Y H:i:s');
      array_push($status_history, $status_history_obj);

      /*if($accepted_by_pro > 0){
        $status = false;
        $message = 'Ticket Already Accepted by: '.$accepted_by_name_pro;
      }else{ 
      }*/
      
      //update ticket comment table
      if($ticket_status_id == 2){
        $update_array = [
          'accepted_by' => $accepted_by,
          'accepted_by_name' => $accepted_by_name,
          'accepted_at' => $accepted_at,
          'status_history' => json_encode($status_history)
        ];

        $temp_deadline = date('Y-m-d H:i:s', strtotime($accepted_at. ' + '.$max_allowed_time.' hours'));
        $temp_deadline = date('Y-m-d H:i:s', strtotime($temp_deadline. ' - '.'24 hours'));
        $holiday_list = $this->db->table('holiday_list')->select('*')->where(['row_status' => 1])->get()->getResult();
        $holidayCount = 0;
        for($x = 0; $x < sizeof($holiday_list); $x++){
            if($holiday_list[$x]->hl_date > $accepted_at && $holiday_list[$x]->hl_date <= $temp_deadline){
                $holidayCount++;
            }//end if
        }//end for
        $max_allowed_time = $max_allowed_time + ($holidayCount * 24);

        $deadline = date('Y-m-d H:i:s', strtotime($accepted_at. ' + '.$max_allowed_time.' hours'));

      }else{
        $update_array = [
          'status_history' => json_encode($status_history)
        ];
      }
      $this->db->table('ticket_comments')->update($update_array, ['ticket_id' => $ticket_id]);

      //update ticket_detail table /
      $update_array1 = [
        'ticket_status' => $ticket_status_id
      ];
      $this->db->table('ticket_details')->update($update_array1, ['ticket_id' => $ticket_id]);
      $message = 'Ticket Status Updated';

      $return_data['status'] = $status;
      $return_data['message'] = $message;
      $return_data['accepted_at'] = $accepted_at;
      $return_data['deadline'] = $deadline;
      $return_data['last_updated'] = date('d-M-Y h:i A');
      return $return_data;
    }//end function 
    

    public function getTicketStatus(){
      $tic_stat_rows = $this->db->table('ticket_status_master')->select('*')->where(['row_status' => 1])->get()->getResult();      
      return $tic_stat_rows;
    }//end function

    public function getHolidayList(){
      $holiday_list = $this->db->table('holiday_list')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $holiday_list;
    }//end function

    /*public function getAllOutlet(){
      $ol_rows = $this->db->table('oultlet')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $ol_rows;
    }//end function

    public function getDesignation(){
      $ol_rows = $this->db->table('oultlet')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $ol_rows;
    }//end function*/


}