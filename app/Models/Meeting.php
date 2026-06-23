<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $guarded = [];

    public function invites()
{
    return $this->hasMany(MeetingInvite::class);
}
}

