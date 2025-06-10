<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\client\{ServiceController,TripController};


Route::prefix('client')->group(function () {


    Route::controller(ServiceController::class)->group(function () {
        Route::get('get-services', 'getServices');
    });


    Route::controller(TripController::class)->group(function () {
        Route::post('get-trip', 'getTrip');
        Route::post('accept-trip', 'acceptTrip');

    });


});





