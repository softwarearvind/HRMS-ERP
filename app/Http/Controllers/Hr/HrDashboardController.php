<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HrDashboardController extends Controller
{
    public function index()
    {
        return view('Hr.index');
    }
}
