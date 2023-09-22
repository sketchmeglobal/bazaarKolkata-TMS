<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'email', 'password'];

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


    public function index()
    {
        return $this->db->table('users')->select('*')->where(['row_status' => 1])->get()->getResult();
    }
    public function password_verify($email, $pass)
    {
        $pass =  hash('sha512', $pass);
        $resultset = $this->db->table('users')->where(['email' => $email, 'password' => $pass])->get()->getResult();
        // echo $this->db->getLastQuery();

        if (count($resultset) > 0) {
            return $resultset;
        } else {
            return 'wrong';
        }
    }
}
