<?php


use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\ServiceController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
  return view("welcome");
});

Route::resource('category', CategoryController::class);
Route::resource('service', ServiceController::class);
Route::get('/lang/{lang}', function ($lang) {
  if (in_array($lang, ['en', 'ar'])) {
    session(['locale' => $lang]);
    App::setLocale($lang);
  }

  return back();
});
