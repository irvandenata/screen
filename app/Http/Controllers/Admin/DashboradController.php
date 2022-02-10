<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboradController extends Controller
{
    public function index()
    {
        $data['title'] = "Dashborad";
        return view('admin.dashborad', $data);
    }
}
