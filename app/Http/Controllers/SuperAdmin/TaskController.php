<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function index()
    {
        $tasks =  Task::with(['assignedBy', 'assignedTo'])->latest()->get();
        $employees =  User::role('employee')->get();
        return view('superadmin.task.index',compact('tasks','employees'));
    }

     public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'assigned_to' => 'required',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_by' => auth()->id(),
            'assigned_to' => $request->assigned_to,
            'deadline' => $request->deadline,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Task Assigned Successfully');
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Task Deleted');
    }



}
