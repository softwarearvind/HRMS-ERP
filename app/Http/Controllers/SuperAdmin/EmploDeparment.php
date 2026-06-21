<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Designation;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeCredentialMail;
use Illuminate\Support\Facades\Storage;


class EmploDeparment extends Controller
{
    public function index()
    {

     $employees =  Employee::with('department','designation')->latest()->get();
     return view('superadmin.Emp.index',compact('employees'));

    }

    public function create()
    {
        $departments = Department::latest()->get();
        $designations = Designation::where('status','active')->get();
        return view('superadmin.Emp.create',compact('departments','designations'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'employee_id'  => 'required|unique:employees',
            'name'         => 'required',
            'email'        => 'required|email|unique:employees',
            'phone'        => 'required',
            'department_id'=> 'required',
            'designation_id'  => 'required',
            'joining_date' => 'required',
        ]);
         $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // default password
    ]);
     $user->assignRole('Employee');

        $photo = null;

        if ($request->hasFile('photo')) {

            $photo = $request->file('photo')
                             ->store('employees', 'public');
        }

       $emp =  Employee::create([
             'user_id' => $user->id,
            'employee_id'   => $request->employee_id,
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'department_id' => $request->department_id,
            'designation_id'   => $request->designation_id,
            'salary'        => $request->salary,
            'joining_date'  => $request->joining_date,
            'status'        => $request->status,
            'photo'         => $photo,
            'password'      => $request->password
        ]);

        Mail::to($user->email)->send(new EmployeeCredentialMail($user, $request->password));

        return redirect()->route('employee.index')->with('success', 'Employee Added Successfully');
    }

    public function destroy($id)
{
    $employee = Employee::with('user')->findOrFail($id);

    // ✅ 1. Delete image from storage folder
    if ($employee->photo && Storage::disk('public')->exists($employee->photo)) {
        Storage::disk('public')->delete($employee->photo);
    }

    // ✅ 2. Delete related user
    if ($employee->user) {
        $employee->user->delete();
    }

    // ✅ 3. Delete employee record
    $employee->delete();

    return back()->with('success', 'Employee Deleted Successfully');
}
}
