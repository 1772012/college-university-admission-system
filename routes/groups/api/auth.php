<?php

use App\Http\Controllers\APIControllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::name('auth.')->prefix('/')->group(function () {

    //  Login
    Route::name('login')->post('/login', [AuthController::class, 'login']);

    //  Auth middleware group
    Route::middleware('auth:api')->group(function () {

        //  Logout
        Route::name('logout')->post('/logout', [AuthController::class, 'logout']);

        //  User profile
        Route::name('user-profile')->get('/user-profile', [AuthController::class, 'userProfile']);
    });
});
