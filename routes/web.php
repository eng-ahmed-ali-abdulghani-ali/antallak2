<?php


use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\ServiceController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
  return view("welcome");
});

Route::middleware([SetLocale::class])->group(function () {
  Route::resource('category', CategoryController::class);
  Route::resource('service', ServiceController::class);
  Route::get('/lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'ar'])) {
      session()->put('langs', $lang);
    }
    return back();
  });
});
