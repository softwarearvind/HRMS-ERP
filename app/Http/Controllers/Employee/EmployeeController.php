<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('Employee.index');
    }

    public function profile()
    {
       $employee = Employee::with(['department', 'designation'])->where('user_id', auth()->id())->first();
        return view('Employee.profile.index',compact('employee'));
    }
}
