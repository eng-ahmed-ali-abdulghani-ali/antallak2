<?php


use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\DriverController;

use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
  return view("welcome");
});

Route::resource('category', CategoryController::class);
Route::resource('service', ServiceController::class);
Route::resource('drivers', DriverController::class);
Route::resource('users',  UserController::class);
