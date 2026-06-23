<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingInvite extends Model
{
       protected $fillable = [
        'meeting_id',
        'user_id',
        'otp',
        'otp_verified',
        'verified_at',
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
