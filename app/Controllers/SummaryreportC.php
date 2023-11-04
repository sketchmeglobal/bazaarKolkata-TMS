<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\SummaryreportM;

class SummaryreportC extends BaseController
{
   public function index($ticket_id){  
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
          $head_officeM = new SummaryreportM();                
         $data['rows'] = $head_officeM->getTicketDetails($ticket_id);               
         $data['tic_stat_rows'] = $head_officeM->getTicketStatus();             
         $data['holiday_list'] = $head_officeM->getHolidayList();
         return view('reports/summary_report', $data);
      }
   }   

   public function formValidationTICR(){
      if($this->request->isAJAX()) {     
         $session = session();
         $logged_in = $session->logged_in;
         $emp_id = $session->emp_id;
         $emp_name = $session->emp_name;
         $email = $session->email;

         $ticket_id = service('request')->getPost('ticket_id');
         $reply_text = service('request')->getPost('reply_text');         

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new SummaryreportM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'reply_text' => 'required'
         ]);

         $data = [
            'reply_text' => $reply_text
         ];
         $validatedData = array();

         if ($validation->run($data)) {
            $validatedData = $validation->getValidated(); 

            $post_data = [
               'ticket_id' => $ticket_id,
               'reply_text' => $reply_text,
               'replied_by' => $emp_id,
               'emp_name' => $emp_name,
               'email' => $email
            ];
            
            $result = $officeM->insertTableData($post_data);

            //echo '****** return form model *******';
            //echo json_encode($result);
            //echo 'ho id: ' . $result['ho_id'];
            $ticket_comment_id = 0;
            $message = $result['message'];
            if($result['status'] == true){
               $status = true;
               $ticket_comment_id = $result['ticket_comment_id'];
               $return_data['ticket_comment_id'] = $ticket_comment_id;
            }else{
               $status = false; 
            }
         }else {
            $return_data['validation'] = $validation->getErrors();
            $status = false;
         } 

         $return_data['status'] = $status;
         $return_data['message'] = $message;

         echo json_encode($return_data);
         //var_dump($this->request->getPost('query'));
     }
   }

     public function checkTicketStatus(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $message = '';
         $officeM = new SummaryreportM();

         $ticketNo = service('request')->getPost('ticketNo');
         $result = $officeM->checkTicketStatus($ticketNo);
         if($result['status'] == true){
            $status = true;
            
         }else{
            $status = false;
            $message = $result['message'];
         }
      }

      $return_data['status'] = $status;
      $return_data['message'] = $message;
      echo json_encode($return_data);
   }//end 

   public function getHwSerialNo(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $message = '';
         $officeM = new SummaryreportM();

         $hw_id = service('request')->getPost('hw_id');
         $result = $officeM->getHwSerialNo($hw_id);
         if($result['status'] == true){
            $status = true;
            $option_text = $result['option_text'];            
         }else{
            $status = false;
         }
      }

      $return_data['status'] = $status;
      $return_data['option_text'] = $option_text;
      echo json_encode($return_data);
   }//end 

   public function removeTableDataHIS(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new SummaryreportM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->removeTableDataHIS($table_id);
         if($result['status'] == true){
         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getTableDataHIS(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new SummaryreportM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->getTableDataHIS($table_id);
         if($result['status'] == true){
            $status = true;
            $row = $result['row'];
            //echo json_encode($row);
            $result = $row[0];
            $return_data['result'] = $result;
         }else{
            $status = false;
         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end    

   public function getDeviceSerialonHIS(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new SummaryreportM();

         $hw_id = service('request')->getPost('hw_id');

         $result = $officeM->getDeviceSerialonHIS($hw_id);
         if($result['status'] == true){
            $status = true;
            $option_text = $result['option_text'];
            $return_data['option_text'] = $option_text;
            //echo json_encode($row);
            
         }else{
            $status = false;
         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end   

   public function acceptTicket(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $officeM = new SummaryreportM();
         $session = session();
         $last_updated = '';

         $ticket_id = service('request')->getPost('ticket_id');

         $ticket_status_id = service('request')->getPost('ticket_status_id');
         $ticket_status_text = service('request')->getPost('ticket_status_text');

         $old_ticket_status_id = service('request')->getPost('old_ticket_status_id');
         $old_ticket_status_text = service('request')->getPost('old_ticket_status_text');
         $max_allowed_time = service('request')->getPost('max_allowed_time');

         $accepted_by = $session->emp_id;
         $accepted_by_name = $session->emp_name;

         $post_data = [
            'ticket_id' => $ticket_id,
            'ticket_status_id' => $ticket_status_id,
            'ticket_status_text' => $ticket_status_text,
            'old_ticket_status_id' => $old_ticket_status_id,
            'old_ticket_status_text' => $old_ticket_status_text,
            'accepted_by' => $accepted_by,
            'accepted_by_name' => $accepted_by_name,
            'max_allowed_time' => $max_allowed_time
         ];
         $result = $officeM->acceptTicket($post_data);
         $message = $result['message'];
         $status = $result['status'];
         $last_updated = $result['last_updated'];
         $deadline = $result['deadline'];         
      }

      $return_data['status'] = $status;
      $return_data['message'] = $message;
      $return_data['last_updated'] = $last_updated;
      $return_data['deadline'] = $deadline;
      echo json_encode($return_data);
   }//end 

}
