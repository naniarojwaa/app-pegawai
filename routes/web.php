<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;

// Halaman utama diarahkan ke Employee
Route::get('/', [EmployeeController::class, 'index'])->name('dashboard');

// Resource route untuk Employee & Department
Route::resource('employees', EmployeeController::class);
Route::resource('departments', DepartmentController::class);

// Halaman tambahan: Attendance, Report, Settings
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/report', [ReportController::class, 'index'])->name('report.index');
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

?>
