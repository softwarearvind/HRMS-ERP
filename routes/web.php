<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\Hr\HrDashboardController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\User\UserManagementController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\SuperAdmin\DepartmentsController;
use App\Http\Controllers\SuperAdmin\EmploDeparment;
use App\Http\Controllers\SuperAdmin\DesignationController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\SuperAdmin\TaskController;
use App\Http\Controllers\Manager\ClientController;
use App\Http\Controllers\Manager\ProjectController;
use App\Http\Controllers\SuperAdmin\MeetingController;





Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['role:Super Admin'])->prefix('super-admin')->group(function () {

    Route::get('/dashboard',[SuperAdminController::class,'index'])->name('super.admin');
    Route::get('/user',[UserManagementController::class,'index'])->name('user.index');
    Route::get('/menu/index',[MenuController::class,'index'])->name('menu.index');
    Route::post('manu/create',[MenuController::class,'store'])->name('manu.create');
    Route::get('/Departments',[DepartmentsController::class,'index'])->name('Departments.index');
    Route::get('/Departments/create',[DepartmentsController::class,'create'])->name('Departments.create');
    Route::post('/departments/store',[DepartmentsController::class,'store'])->name('departments.store');
    Route::get('/employee',[EmploDeparment::class,'index'])->name('employee.index');
    Route::get('employees/create',[EmploDeparment::class,'create'])->name('employees.create');
    Route::post('/employees/store',[EmploDeparment::class,'store'])->name('employees.store');
    Route::delete('/employees.delete/{id}',[EmploDeparment::class,'destroy'])->name('employees.delete');
    // Assign Manager
    Route::get('/assign/manager',[SuperAdminController::class,'assign'])->name('assign.manager');
    Route::post('/assign-manager', [SuperAdminController::class, 'storeManager'])->name('assign.manager.store');

    //dg
   Route::get('/designation', [DesignationController::class, 'index'])->name('designation.index');
   Route::get('/designation/create',[DesignationController::class,'create'])->name('designation.create');
   Route::post('/designation/store',[DesignationController::class,'store'])->name('designation.store');

   //task

   Route::get('/tasks',[TaskController::class,'index'])->name('task.index');
   Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
   Route::delete('/task/destroy/{id}', [TaskController::class, 'destroy'])->name('task.destroy');

   //approved
   Route::get('/client/approved', [SuperAdminController::class, 'approved'])->name('client.approved');
   Route::post('/client/approved/{id}', [SuperAdminController::class, 'approvedClient'])->name('client.approve');
   Route::post('/client/reject/{id}',[SuperAdminController::class,'rejectClient'])->name('client.reject');

   //meeting

    Route::get('/meeting',[MeetingController::class,'index'])->name('meeting.index');
    Route::get('/meetings/create',[MeetingController::class,'create'])->name('meetings.create');
    Route::post('/meetings/store',[MeetingController::class,'store'])->name('meetings.store');




    });

    Route::middleware(['role:HR Manager'])->prefix('hr')->group(function ()
    {
    Route::get('/dashboard', [HrDashboardController::class, 'index'])->name('hr.dashboard');


    });

     Route::middleware(['role:Manager'])->prefix('manager')->group(function ()
    {
    Route::get('/dashboard', [ManagerController::class, 'index'])->name('manager.dashboard');
    Route::resource('clients', ClientController::class);
    Route::get('/projects',[ProjectController::class,'index'])->name('projects.index');
    Route::post('/projects.store',[ProjectController::class,'store'])->name('projects.store');
    Route::post('/ai/suggest', [ProjectController::class, 'aiSuggest']);

    });

    Route::middleware(['role:Employee'])->prefix('employee')->group(function ()
    {
    Route::get('/dashboard', [EmployeeController::class, 'index'])->name('employee.dashboard');
    Route::get('/profile', [EmployeeController::class, 'profile'])->name('profile.index');
    Route::get('/task/show',[EmployeeController::class,'showtask'])->name('task.show');
    Route::post('/task/status/{id}', [EmployeeController::class, 'updateStatus'])->name('task.status');

    //Attendance

Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.checkin');
Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut'])->name('attendance.checkout');
Route::get('/face-register/{id}', [AttendanceController::class, 'face'])->name('face.index');


//notification
Route::get('/join/meeting', [EmployeeController::class, 'notifications'])->name('join.meeting');
Route::post('/meeting/verifyOtp',[EmployeeController::class,'verifyOtp'])->name('meeting.verifyOtp');

    });







Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
