<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;

class EmployeeC extends BaseController
{
     public function index(){
        return view('master/employee');
     }
}
