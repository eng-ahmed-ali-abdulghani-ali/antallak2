<?php

use App\Http\Controllers\api\{profile\ProfileController};
use App\Http\Controllers\api\auth\AuthController;
use Illuminate\Support\Facades\Route;




// Guest-only client auth routes (sign-up, OTP verification, sign-in) handled by AuthController
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::post('sign-up', 'signUp');
    Route::post('verify-otp', 'verifyOTP');
    Route::post('sign-in', 'signIn');
});


Route::middleware('auth:sanctum')->controller(ProfileController::class)->group(function () {

    Route::PUT('update-profile', 'UpdateProfile');

});







