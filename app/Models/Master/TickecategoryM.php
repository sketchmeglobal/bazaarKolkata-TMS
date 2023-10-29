<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class TickecategoryM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ticket_category_master';
    protected $primaryKey       = 'ticket_category_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ticket_category_id','ticket_category_name'];

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

    public function getAllTicketCategory(){
      $rows = $this->db->table('ticket_category_master')->select('ticket_category_master.ticket_category_id, ticket_category_master.topic_id, ticket_category_master.ticket_category_name, topic_master.topic_name')->join('topic_master', 'topic_master.topic_id = ticket_category_master.topic_id')->where(['ticket_category_master.row_status' => 1])->limit(100)->get()->getResult();
      return $rows;
    }//end function

    public function insertTableData($validatedData){
      $status = true;
      $return_data = array();
      $ticket_category_id = 0;
      $table_id = $validatedData['table_id'];

      $fields_array = [
        'topic_id'     => $validatedData['topic_id'],
        'ticket_category_name'     => $validatedData['ticket_category_name']
      ];

      if($table_id > 0){
        //update query
        //$this->db->table('ticket_category_master')->update($fields_array)->where('id', $table_id);
        $this->db->table('ticket_category_master')->update($fields_array, ['ticket_category_id' => $table_id]);
      }else{
        //insert query
        $this->db->table('ticket_category_master')->insert($fields_array);
        $ticket_category_id = $this->db->insertID();
        if($ticket_category_id > 0){
          $status = true;          
        }else{
          $status = false;
        }
      }

      $return_data['status'] = $status;
      $return_data['ticket_category_id'] = $ticket_category_id;
      return $return_data;
    }

    // public function select(){  
    //   return $this->db->table('ticket_category_master')->select('*')->where(['row_status' => 1])->get()->getResult();
    // } 

    public function removeTableDataTC($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('ticket_category_master')->where('ticket_category_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataTC($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('ticket_category_master')->select('*')->where(['row_status' => 1, 'ticket_category_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function

    public function getAllTicketTopic(){
      $tt_rows = $this->db->table('topic_master')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $tt_rows;
    }//end function
}