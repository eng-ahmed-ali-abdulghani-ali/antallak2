<?php

use App\Http\Controllers\api\client\AuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('client')->group(function () {


// Guest-only client auth routes (sign-up, OTP verification, sign-in) handled by AuthController
    Route::middleware('guest')->controller(AuthController::class)->group(function () {
        Route::post('sign-up', 'signUp');
        Route::post('verify-otp', 'verifyOTP');
        Route::post('sign-in', 'signIn');
    });
    



});





