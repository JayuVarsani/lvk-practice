<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('table', ['title' => 'Dashboard']);
    }



    public function purchase_order()
    {

    }
}
