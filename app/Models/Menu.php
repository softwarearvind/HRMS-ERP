<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
     protected $fillable = [
        'name',
        'route',
        'icon',
        'role',
        'parent_id',
        'sort_order'
    ];
}
