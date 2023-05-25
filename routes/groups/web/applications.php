<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->name('applications.')->prefix('/applications')->group(function () {

        //  Index
        Route::name('index')->get('/', [ApplicationController::class, 'index']);

        //  Create
        Route::name('create')->get('/{user}/create', [ApplicationController::class, 'create']);

        //  Datatables
        Route::name('datatables')->get('/datatables', [ApplicationController::class, 'datatables']);

        //  Store
        Route::name('store')->post('/{user}/store', [ApplicationController::class, 'store']);

        //  Destroy
        Route::name('destroy')->post('/{application}/destroy', [ApplicationController::class, 'destroy']);
    });
