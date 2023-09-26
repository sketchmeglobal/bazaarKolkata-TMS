<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;

class HardwareStockEntryC extends BaseController
{
     public function index(){
        return view('master/hardwarestockentry');
     }
}
