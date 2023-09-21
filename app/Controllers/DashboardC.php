<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardC extends BaseController
{
    public function index()
    {
        return view('dashboard/index');
    }
    public function all_tickets()
    {
        return view('dashboard/all-tickets');
    }
    public function profile()
    {
        return view('dashboard/profile');
    }
    public function site_hierancy()
    {
        return view('dashboard/site-hierancy');
    }
    public function sr_association()
    {
        return view('dashboard/sr-association');
    }
    public function severity()
    {
        return view('dashboard/severity-mapping');
    }
    public function internet_masg()
    {
        return view('dashboard/intranet-massaging');
    }
    public function all_users()
    {
        return view('dashboard/all-users');
    }
    public function new_ticket()
    {
        return view('dashboard/new-ticket');
    }
    // FOR VIEW TICKETS
    public function view_tickets1()
    {
        return view('view-tickets/view-tickets');
    }
    public function view_tickets2()
    {
        return view('view-tickets/view-tickets2');
    }
}