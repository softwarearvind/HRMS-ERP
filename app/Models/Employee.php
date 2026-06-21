<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
    'user_id',
    'employee_id',
    'name',
    'email',
    'phone',
    'department_id',
    'designation_id',
    'salary',
    'joining_date',
    'status',
    'photo',

];

     public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function manager()
{
    return $this->belongsTo(Employee::class, 'manager_id');
}

public function subordinates()
{
    return $this->hasMany(Employee::class, 'manager_id');
}

public function attendances()
{
    return $this->hasMany(Attendance::class);
}

}


