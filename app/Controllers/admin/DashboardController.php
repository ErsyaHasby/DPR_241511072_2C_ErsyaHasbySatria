<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        // Nanti kita akan tambahkan data statistik di sini
        return view('admin/dashboard_view');
    }
}