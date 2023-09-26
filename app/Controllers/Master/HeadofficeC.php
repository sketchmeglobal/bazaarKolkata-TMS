<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\Master\HeadofficeM;

class HeadofficeC extends BaseController
{
   public function index()
   {

      if ($this->request->getVar('submit')) {
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
               'location' => $address,

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
            $f_data['head'] = $head_officeM->findAll();
            return view('master/head-office', $f_data);
      }
   }
}