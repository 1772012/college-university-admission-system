<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->name('dashboard.')->prefix('/dashboard')->group(function () {

    //  Index
    Route::name('index')->get('/', [DashboardController::class, 'index']);
});
