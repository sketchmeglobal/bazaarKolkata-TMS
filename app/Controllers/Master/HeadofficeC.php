<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\Master\HeadofficeM;

class HeadofficeC extends BaseController
{
   public function index()
   {
      
      $head_officeM = new HeadofficeM();            
      $data['head'] = $head_officeM->findAll();            
      return view('master/head-office', $data);

      /*if ($this->request->getVar('submit')) {
         //$data = array();
         $session = session();
         $officeM = new HeadofficeM();
            
         $rules = [
            'name' => 'required|min_length[5]',
            'address' => 'required|min_length[10]',
         ];

         if ($this->validate($rules)) {
            $name = $this->request->getVar('name');
            $address = $this->request->getVar('address');
            $ins_data = [
               'name' => $name,
               'location' => $address
            ];            
        
            $result = $officeM->office($ins_data);
            //$result = true;
            if($result == true) {               
               $session->setFlashdata('msg', 'Wrong Input');                    
               return view('master/head-office');               
            }else {            
               $ses_data = [
                  'name'     => $data[0]->name,
                  'address'  => $data[0]->address,
               ];

               $session->set($ses_data);
               return redirect()->to(base_url('master/head-office'));
            }
            
         }else {
            $data['validation'] = $this->validator->getErrors();
            $data['name'] = $this->request->getVar('name');
            $data['address'] = $this->request->getVar('address');
            return view('master/head-office', $data);
         } 
      } else {
            $head_officeM = new HeadofficeM();            
            $data['head'] = $head_officeM->findAll();            
            return view('master/head-office', $data);
      }*/
   }

   public function formValidation(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $headofficeName = $query['headofficeName'];
         $headofficeLocation = $query['headofficeLocation'];
         $table_id = $query['table_id'];

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new HeadofficeM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'headofficeName' => 'required|min_length[5]',
            'headofficeLocation' => 'required|min_length[5]',
            'table_id' => 'required'
         ]);

         $data = [
            'headofficeName'   => $headofficeName,
            'headofficeLocation'   => $headofficeLocation,
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

   public function removeTableData(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new HeadofficeM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->removeTableData($table_id);
         if($result['status'] == true){

         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getTableData(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new HeadofficeM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->getTableData($table_id);
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