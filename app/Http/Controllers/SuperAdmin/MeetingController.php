<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Mail\MeetingOtpMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\MeetingInvite;
use App\Models\Notification;
class MeetingController extends Controller
{
    public function index()
    {
        $meetings = Meeting::all();
        return view('superadmin.Meting.index', compact('meetings'));
    }

    public function create()
    {
         $users = User::role(['Manager','Employee'])->get();
        return view('superadmin.Meting.create', compact('users'));
    }

    public function store(Request $request)
    {

        $request->validate([
        'title' => 'required',
        'description' => 'nullable',
        'meeting_link' => 'required|url',
        'meeting_date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
    ]);

    $meeting = Meeting::create([
        'title' => $request->title,
        'description' => $request->description,
        'meeting_link' => $request->meeting_link,
        'meeting_date' => $request->meeting_date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
    ]);

    // 👇 USERS LOOP (Manager + Employee)
    foreach ($request->users as $userId) {

        $otp = rand(100000, 999999);

        MeetingInvite::create([
            'meeting_id' => $meeting->id,
            'user_id' => $userId,
            'otp' => $otp,
            'otp_verified' => 0,
        ]);

        $user = User::find($userId);

        // ✅ MAIL SEND
        Mail::to($user->email)->send(
            new MeetingOtpMail($otp)
        );
          Notification::create([
        'user_id' => $userId,
        'title' => 'New Meeting Assigned',
        'message' => 'You have a new meeting: ' . $meeting->title,
    ]);
    }

    return redirect()->route('meeting.index')
        ->with('success', 'Meeting created & OTP sent successfully.');
    }
}
