<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Task;
use App\Models\Meeting;
use App\Models\MeetingInvite;

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

    public function showtask()
    {
         $tasks = Task::where('assigned_to', auth()->id())->latest()->get();
        return view('Employee.taskshow.index',compact('tasks'));
    }

       public function updateStatus(Request $request, $id)
    {
        $task = Task::where('assigned_to', auth()->id())
                    ->findOrFail($id);

        $task->status = $request->status;

        if ($request->status == 'completed') {
            $task->completed_at = now();
        }

        $task->save();

        return redirect()->back()->with('success', 'Task Status Updated');
    }

    public function notifications()

     {
        $meetings = Meeting::whereHas('invites', function($q){
        $q->where('user_id', auth()->id());
    })->get();
        return view('Employee.Meeting.index', compact('meetings'));
      }


      public function verifyOtp(Request $request)
{
    $invite = MeetingInvite::where('meeting_id', $request->meeting_id)
        ->where('user_id', auth()->id())
        ->where('otp', $request->otp)
        ->first();

    if (!$invite) {
        return back()->with('error', 'Invalid OTP');
    }

    $invite->update([
        'otp_verified' => 1,
        'verified_at' => now()
    ]);

    return back()->with('success', 'OTP Verified Successfully');
}
}
