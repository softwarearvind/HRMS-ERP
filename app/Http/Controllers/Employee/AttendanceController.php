<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class AttendanceController extends Controller
{

 public function index(Request $request)
{
    $employee = Employee::where('user_id', auth()->id())->first();

    if (!$employee) {
        return back()->with('error', 'Employee not found');
    }

    $date = $request->date ?? Carbon::today()->toDateString();

    $attendances = Attendance::with('employee')
        ->where('employee_id', $employee->id)
        ->whereDate('date', $date)
        ->get();

    $presentCount = Attendance::where('employee_id', $employee->id)
        ->whereDate('date', $date)
        ->where('status', 'Present')
        ->count();

    $absentCount = Attendance::where('employee_id', $employee->id)
        ->whereDate('date', $date)
        ->where('status', 'Absent')
        ->count();

    $lateCount = Attendance::where('employee_id', $employee->id)
        ->whereDate('date', $date)
        ->where('status', 'Late')
        ->count();

    $totalCount = Attendance::where('employee_id', $employee->id)
        ->whereDate('date', $date)
        ->count();

    return view('Employee.attendance.index', compact(
        'attendances',
        'presentCount',
        'absentCount',
        'lateCount',
        'totalCount'
    ));
}

public function checkIn()
{
    $employee = Employee::where('user_id', auth()->id())->first();

    if (!$employee) {
        return back()->with('error', 'Employee not found');
    }

    $today = Carbon::today();

    // ⏰ current time
    $currentTime = Carbon::now()->format('H:i:s');

    // ⏰ cutoff time
    $lateTime = '10:00:00';

    // 🎯 auto status
    $status = ($currentTime > $lateTime) ? 'Late' : 'Present';

    $attendance = Attendance::firstOrCreate(
        [
            'employee_id' => $employee->id,
            'date' => $today
        ],
        [
            'check_in' => $currentTime,
            'status' => $status
        ]
    );

    return back()->with('success', 'Check In Successful');
}

public function checkOut()
{
    $employee = Employee::where('user_id', auth()->id())->first();

    if (!$employee) {
        return back()->with('error', 'Employee not found');
    }

    $attendance = Attendance::where('employee_id', $employee->id)
        ->whereDate('date', Carbon::today())
        ->first();

    if ($attendance) {
        $attendance->update([
            'check_out' => Carbon::now()->format('H:i:s')
        ]);
    }

    return back()->with('success', 'Check Out Successful');
}

public function face($id)
{
     $employee = Employee::where('user_id', Auth::id())->firstOrFail();
   

    return view('Employee.face.index', compact('employee'));
}


}
