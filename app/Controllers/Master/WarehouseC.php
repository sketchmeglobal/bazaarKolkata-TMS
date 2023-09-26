<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;

class WarehouseC extends BaseController
{
     public function index(){
        return view('master/warehouse');
     }
}
