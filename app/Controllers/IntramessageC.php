<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\IntramessageM;

class IntramessageC extends BaseController
{
   public function index(){
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
          $head_officeM = new IntramessageM();   
          $session = session();
          $emp_id = $session->emp_id;         
         $data['rows'] = $head_officeM->getAllMessage($emp_id);            
         return view('message/intranet-messaging', $data);
      }
   }

   public function formValidationIM(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $message = $query['message'];
         $end_date = $query['end_date'];
         //$table_id = $query['table_id'];

         $return_data = array();
         $status = true;
         $session = session();
         $emp_id = $session->emp_id;
         $officeM = new IntramessageM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'message' => 'required|min_length[5]',
            'end_date' => 'required|min_length[1]'
         ]);

         $data = [
            'message'   => $message,
            'end_date'   => $end_date
         ];
         $validatedData = array();

         $pose_data = [
            'message'   => $message,
            'end_date'   => $end_date,
            'emp_id' => $emp_id
         ];

         if ($validation->run($data)) {
            $validatedData = $validation->getValidated(); 
            //print_r($validatedData);
            $result = $officeM->insertTableData($pose_data);
            
            if($result['status'] == true){
               $status = true;
               $im_id = $result['im_id'];
               $return_data['im_id'] = $im_id;
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

   public function removeTableDataDG(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new IntramessageM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->removeTableDataDG($table_id);
         if($result['status'] == true){

         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getTableDataDG(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new IntramessageM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->getTableDataDG($table_id);
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

   public function getDesigTableData(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new IntramessageM();

         $ho_id = service('request')->getPost('ho_id');
         $wh_id = service('request')->getPost('wh_id');
         $ol_id = service('request')->getPost('ol_id');

         $result = $officeM->getDesigTableData($ho_id, $wh_id, $ol_id);
         echo json_encode($result);
         
         // if($result['status'] == true){
         //    $status = true;
         //    $row = $result['row'];
         //    echo json_encode($row);
         //    $result = $row[0];
         //    $return_data['result'] = $result;
         // }else{
         //    $status = false;
         // }
      }

      // $return_data['status'] = $status;
      // echo json_encode($return_data);
      
   }//end 

}