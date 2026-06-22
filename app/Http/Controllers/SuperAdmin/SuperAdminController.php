<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Client;

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

public function approved()
{
     $clients = Client::where('status','pending')->get();
    return view('superadmin.clientapproved.index', compact('clients'));
}

public function approvedClient($id)
{
    $client = Client::findOrFail($id);

    // Only pending client can be approved
    if ($client->status !== 'pending') {
        return back()->with('error', 'Client already processed.');
    }

    $client->update([
        'status' => 'approved'
    ]);

    return back()->with('success', 'Client approved successfully.');
}

public function rejectClient($id)
{
    $client = Client::findOrFail($id);

    // Only pending client can be rejected
    if ($client->status !== 'pending') {
        return back()->with('error', 'Client already processed.');
    }

    $client->update([
        'status' => 'rejected'
    ]);

    return back()->with('success', 'Client rejected successfully.');
}



}
