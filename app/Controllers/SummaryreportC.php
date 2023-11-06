<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\SummaryreportM;

class SummaryreportC extends BaseController
{
   public function index($ticket_id){  
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
          $head_officeM = new SummaryreportM();                
         $data['rows'] = $head_officeM->getTicketDetails($ticket_id);               
         $data['tic_stat_rows'] = $head_officeM->getTicketStatus();             
         $data['holiday_list'] = $head_officeM->getHolidayList();
         return view('reports/summary_report', $data);
      }
   } 

}
