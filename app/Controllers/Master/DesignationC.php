<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\Master\DesignationM;

class DesignationC extends BaseController
{
   public function index(){      
      $head_officeM = new DesignationM();            
      $data['rows'] = $head_officeM->findAll();            
      return view('master/designation', $data);
   }

   public function formValidationDG(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $desig_name = $query['desig_name'];
         $desig_priority = $query['desig_priority'];
         $table_id = $query['table_id'];

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new DesignationM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'desig_name' => 'required|min_length[5]',
            'desig_priority' => 'required|min_length[1]',
            'table_id' => 'required'
         ]);

         $data = [
            'desig_name'   => $desig_name,
            'desig_priority'   => $desig_priority,
            'table_id' => $table_id
         ];
         $validatedData = array();

         if ($validation->run($data)) {
            $validatedData = $validation->getValidated(); 
            //print_r($validatedData);
            $result = $officeM->insertTableData($validatedData);

            //echo '****** return form model *******';
            //echo json_encode($result);
            //echo 'ho id: ' . $result['ho_id'];
            $ho_id = 0;
            if($result['status'] == true){
               $status = true;
               $ho_id = $result['ho_id'];
               $return_data['ho_id'] = $ho_id;
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
         $officeM = new DesignationM();

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
         $officeM = new DesignationM();

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

}