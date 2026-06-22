<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
      protected $fillable = [
        'title',
        'description',
        'assigned_by',
        'assigned_to',
        'status',
        'deadline',
    ];
     public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    /**
     * Task jis employee ko mila hai
     */
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
