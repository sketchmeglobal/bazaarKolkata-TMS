<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthM;

class IssuehardwareC extends BaseController
{
     public function index(){
        return view('issuehardware');
     }
}
