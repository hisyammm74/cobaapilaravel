<?php

use Illuminate\Http\Request;
use App\Http\Controllers\employeecontroller;
use Illuminate\Support\Facades\Route;

Route::apiResource('employee',employeecontroller::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
