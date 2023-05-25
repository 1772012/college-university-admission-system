<?php

use App\Http\Controllers\APIControllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->name('users.')->prefix('/users')->group(function () {

        //  Fetch
        Route::name('fetch')->get('/fetch', [UserController::class, 'fetch']);

        //  Search
        Route::name('search')->get('/search', [UserController::class, 'search']);

        //  Store
        Route::name('store')->post('/store', [UserController::class, 'store']);

        //  Update
        Route::name('update')->post('/{user}/update', [UserController::class, 'update']);

        //  Destroy
        Route::name('destroy')->post('/{user}/destroy', [UserController::class, 'destroy']);
    });
