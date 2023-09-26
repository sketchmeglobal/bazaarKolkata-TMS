<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;

class DepartmentC extends BaseController
{
     public function index(){
        return view('master/department');
     }
}
