<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->name('applications.')
    ->prefix('/applications')
    ->group(function () {

        //  Index
        Route::name('index')
            ->get('/', [ApplicationController::class, 'index']);

        //  Create
        Route::name('create')
            ->get('/{user}/create', [ApplicationController::class, 'create']);

        //  Datatables
        Route::name('datatables')
            ->get('/datatables', [ApplicationController::class, 'datatables']);

        //  Fetch
        Route::name('fetch')
            ->get('/{user}/fetch', [ApplicationController::class, 'fetch']);

        //  Search
        Route::name('search')
            ->get('/{user}/search', [ApplicationController::class, 'search']);

        //  Store
        Route::name('store')
            ->post('/{user}/store', [ApplicationController::class, 'store']);

        //  Destroy
        Route::name('destroy')
            ->post('/{application}/destroy', [ApplicationController::class, 'destroy']);
    });
