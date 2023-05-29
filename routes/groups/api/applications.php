<?php

use App\Http\Controllers\APIControllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->name('applications.')->prefix('/applications')->group(function () {

        //  Fetch
        Route::name('fetch')->get('/{user}/fetch', [ApplicationController::class, 'fetch']);

        //  Search
        Route::name('search')->get('/{user}/search', [ApplicationController::class, 'search']);

        //  Store
        Route::name('store')->post('/{user}/store', [ApplicationController::class, 'store']);

        //  Destroy
        Route::name('destroy')->post('/{application}/destroy', [ApplicationController::class, 'destroy']);
    });
