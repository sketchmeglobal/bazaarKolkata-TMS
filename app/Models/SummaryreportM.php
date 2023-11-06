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

    public function getTicketStatus(){
      $tic_stat_rows = $this->db->table('ticket_status_master')->select('*')->where(['row_status' => 1])->get()->getResult();      
      return $tic_stat_rows;
    }//end function

    public function getHolidayList(){
      $holiday_list = $this->db->table('holiday_list')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $holiday_list;
    }//end function

}