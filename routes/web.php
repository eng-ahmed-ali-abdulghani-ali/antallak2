<?php


use App\Http\Controllers\dashboard\CategoryController;
use Illuminate\Support\Facades\Route;


Route::prefix('category')->group(function () {
  Route::controller(CategoryController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
  });
});
