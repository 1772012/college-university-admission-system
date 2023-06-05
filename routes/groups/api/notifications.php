<?php

use App\Http\Controllers\APIControllers\NotificationController;
use App\Http\Controllers\APIControllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->name('notifications.')->prefix('/users/{user}/notifications/')->group(function () {

    //  Fetch
    Route::name('fetch')->get('/fetch', [NotificationController::class, 'fetch']);

    //  Update
    Route::name('update')->post('/{notification}/update', [NotificationController::class, 'update']);

    //  Destroy
    Route::name('destroy')->post('/{notification}/destroy', [NotificationController::class, 'destroy']);
});
