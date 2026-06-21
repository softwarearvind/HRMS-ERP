<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('superadmin.index');
    }

    //assignmanager

    public function assign()
    {
         $employees = Employee::all();
        return view('superadmin.assign.index',compact('employees'));
    }



public function storeManager(Request $request)
{
    $request->validate([
        'employee_id' => 'required',

    ]);

    Employee::where('employee_id', $request->employee_id)
        ->update([
            'manager_id' => $request->employee_id
        ]);

    return back()->with('success', 'Manager Assigned Successfully');
}
}
