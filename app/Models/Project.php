<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'client_id',
        'project_name',
        'description',
        'start_date',
        'end_date',
        'status',
    ];

    // Client Relation
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
