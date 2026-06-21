<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
      protected $fillable = [
        'department_name',
        'department_code',
        'head_name',
        'status',
        'description',
    ];

 public function designations()
{
    return $this->hasMany(Designation::class);
}

public function employees()
{
    return $this->hasMany(Employee::class);
}


}
