<?php

use App\Http\Controllers\EmployeeController;

use Illuminate\Support\Facades\Route;

Route::apiResource('employee',employeecontroller::class);

Route::get('/', function () {
    return view('welcome');
});



Route::get('/tampil', function () {
    return view('tampil');
})->name('employee.view');

// Route untuk handle pengambilan data
Route::get('/api/employee', [EmployeeController::class, 'index'])->name('employee.index');

// Route untuk handle penyimpanan data
Route::post('/api/employee', [EmployeeController::class, 'store'])->name('employee.store');

Route::apiResource('employee', EmployeeController::class);
