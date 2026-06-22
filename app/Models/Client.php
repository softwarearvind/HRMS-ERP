<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
     protected $fillable = [
        'client_name',
        'company_name',
        'email',
        'phone',
        'address',
        'status',
        'manager_id'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class,'manager_id');
    }

    public function projects()
{
    return $this->hasMany(Project::class);
}
}
