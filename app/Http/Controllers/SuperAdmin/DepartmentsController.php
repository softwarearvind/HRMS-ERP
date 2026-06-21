<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\View\View;

class DepartmentsController extends Controller
{
    public function index()
    {
        $departments =  Department::withCount('employees')->latest()->get();
        return view('superadmin.Departments.index',compact('departments'));
    }

    public function create()
    {
      return View('superadmin.Departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'department_name' => 'required',
        'department_code' => 'required|unique:departments',
    ]);

    Department::create($request->all());
    return redirect()->route('Departments.index')->with('success', 'Department Created Successfully');
    }
}
