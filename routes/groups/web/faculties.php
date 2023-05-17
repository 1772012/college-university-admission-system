<?php

use App\Http\Controllers\FacultyController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->name('faculties.')
    ->prefix('/faculties')
    ->group(function () {

        //  Index
        Route::name('index')
            ->get('/', [FacultyController::class, 'index']);

        //  Datatables
        Route::name('datatables')
            ->get('/datatables', [FacultyController::class, 'datatables']);

        //  Fetch
        Route::name('fetch')
            ->get('/fetch', [FacultyController::class, 'fetch']);

        //  Search
        Route::name('search')
            ->get('/search', [FacultyController::class, 'search']);
    });
