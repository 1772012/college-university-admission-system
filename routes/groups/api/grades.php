<?php

use App\Http\Controllers\APIControllers\GradeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->name('grades.')->prefix('/grades')->group(function () {

    //  Fetch
    Route::name('fetch')->get('/{user}/fetch', [GradeController::class, 'fetch']);

    //  Store
    Route::name('store')->post('/{user}/store', [GradeController::class, 'store']);
});
