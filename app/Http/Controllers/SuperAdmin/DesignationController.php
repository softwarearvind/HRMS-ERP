<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
        $department =  Designation::with('department')->get();

        return view('superadmin.Designation.index',compact('department'));
    }

    public function create()
    {
       $departments = Department::where('status', 'active')->get();
      return view('superadmin.Designation.create',compact('departments'));
    }

    public function store(Request $request)
    {

         $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name'          => 'required|unique:designations,name',

        ]);

        Designation::create([
            'department_id' => $request->department_id,
            'name'          => $request->name,
            'description'   => $request->description,

        ]);

        return redirect()->route('designation.index')->with('success', 'Designation Added Successfully');

    }
}
