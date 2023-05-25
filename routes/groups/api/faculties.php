<?php

use App\Http\Controllers\APIControllers\FacultyController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->name('faculties.')->prefix('/faculties')->group(function () {

        //  Fetch
        Route::name('fetch')
            ->get('/fetch', [FacultyController::class, 'fetch']);

        //  Search
        Route::name('search')
            ->get('/search', [FacultyController::class, 'search']);
    });
