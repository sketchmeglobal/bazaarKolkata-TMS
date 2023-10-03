<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class EmployeeM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'employee';
    protected $primaryKey       = 'emp_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['emp_id','emp_name', 'primary_phone'];

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


    public function office($ins_data){
      $this->db->table('employee')->insert($ins_data);
      return true;
    }

    public function insertTableData($validatedData){
      $status = true;
      $return_data = array();
      $ho_id = 0;
      $table_id = $validatedData['table_id'];
      $ho_id = $validatedData['ho_id'];
      $wh_id = $validatedData['wh_id'];
      $ol_id = $validatedData['ol_id'];

      $fields_array = [
        'ho_id' => $ho_id,
        'wh_id' => $wh_id,
        'ol_id' => $ol_id,
        'emp_name' => $validatedData['emp_name'],
        'primary_phone' => $validatedData['primary_phone'],
        'secondary_phone' => $validatedData['secondary_phone'],
        'email_id' => $validatedData['email_id']
      ];

      if($table_id > 0){
        //update query
        $this->db->table('employee')->update($fields_array, ['emp_id' => $table_id]);
      }else{
        //insert query
        $this->db->table('employee')->insert($fields_array);
        $emp_id = $this->db->insertID();
        if($emp_id > 0){
          $status = true;          
        }else{
          $status = false;
        }
      }

      $return_data['status'] = $status;
      $return_data['emp_id'] = $emp_id;
      return $return_data;
    }

    public function removeTableDataEM($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('employee')->where('emp_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataDG($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('employee')->select('*')->where(['row_status' => 1, 'emp_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
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

      $result = $this->db->table('employee')->select('*')->where(['ho_id' => $ho_id, 'wh_id' => $wh_id, 'ol_id' => $ol_id, 'row_status' => 1 ])->get()->getResult();

      //echo json_encode($result);

      $counter = 1;
      if(count($result) > 0){
        for($i = 0; $i < sizeof($result); $i++){
          $nestedData['slNo'] = $counter;
          $nestedData['emp_name'] = $result[$i]->emp_name;
          $nestedData['primary_phone'] = $result[$i]->primary_phone;
          $nestedData['secondary_phone'] = $result[$i]->secondary_phone;
          $nestedData['email_id'] = $result[$i]->email_id;
          $nestedData['action'] = '<td class="d-flex justify-content-evenly"><a href="javascript: void(0);" class="edit_class" data-table_id="'.$result[$i]->emp_id.'"><i class="fa fa-edit"></i></a> <a class="remove" href="javascript: void(0);"><i class="fas fa-times" data-table_id="'.$result[$i]->emp_id.'"></i></a></td>';

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
    

    public function getAllHeadOffice(){
      $ho_rows = $this->db->table('head_office')->select('*')->where(['row_status' => 1])->get()->getResult();      
      return $ho_rows;
    }//end function

    public function getAllWareHouse(){
      $wh_rows = $this->db->table('ware_house')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $wh_rows;
    }//end function

    public function getAllOutlet(){
      $ol_rows = $this->db->table('oultlet')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $ol_rows;
    }//end function

    public function getDesignation(){
      $ol_rows = $this->db->table('oultlet')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $ol_rows;
    }//end function


}