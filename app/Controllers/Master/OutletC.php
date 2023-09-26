<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;

class OutletC extends BaseController
{
     public function index(){
        return view('master/outlet');
     }
}
