<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\NewticketM;

class NewticketC extends BaseController
{
   public function index(){  
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
          $head_officeM = new NewticketM();                
         //$data['rows'] = $head_officeM->findAll();    
         $data['topic_rows'] = $head_officeM->getTopicMaster();    
         $data['category_rows'] = $head_officeM->getCategoryMaster();   
         $data['severty_rows'] = $head_officeM->getSeverityMaster();
         return view('tickets/new-ticket', $data);
      }
   }   

   public function formValidationTIC(){
      if($this->request->isAJAX()) {      
         $session = session();
         $logged_in = $session->logged_in;
         $emp_id = $session->emp_id;
         
         $query = service('request')->getPost('query');
         $topic_id = $query['topic_id'];
         $ticket_subject = $query['ticket_subject'];
         $ticket_category = $query['ticket_category'];
         $ticket_severity = $query['ticket_severity'];
         $authority_cc = $query['authority_cc'];
         $ticket_purpose = $query['ticket_purpose'];
         $ticket_description = $query['ticket_description'];

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new NewticketM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'topic_id' => 'required',
            'ticket_subject' => 'required'
         ]);

         $data = [
            'topic_id' => $topic_id,
            'ticket_subject' => $ticket_subject
         ];
         $validatedData = array();

         if ($validation->run($data)) {
            $validatedData = $validation->getValidated(); 

            $post_data = [
               'topic_id' => $topic_id,
               'ticket_subject' => $ticket_subject,
               'ticket_category' => $ticket_category,
               'ticket_severity' => $ticket_severity,
               'authority_cc' => $authority_cc,
               'ticket_purpose' => $ticket_purpose,
               'ticket_description' => $ticket_description,
               'created_by' => $emp_id
            ];
            
            $result = $officeM->insertTableData($post_data);

            //echo '****** return form model *******';
            //echo json_encode($result);
            //echo 'ho id: ' . $result['ho_id'];
            $ticket_id = 0;
            if($result['status'] == true){
               $status = true;
               $ticket_id = $result['ticket_id'];
               $return_data['ticket_id'] = $ticket_id;
            }else{
               $status = false; 
            }
         }else {
            $return_data['validation'] = $validation->getErrors();
            $status = false;
         } 

         $return_data['status'] = $status;

         echo json_encode($return_data);
         //var_dump($this->request->getPost('query'));
     }
   }

     public function checkTicketStatus(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $message = '';
         $officeM = new NewticketM();

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
         $officeM = new NewticketM();

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
         $officeM = new NewticketM();

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
         $officeM = new NewticketM();

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
         $officeM = new NewticketM();

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

}
