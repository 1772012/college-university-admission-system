<?php

use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->name('grades.')->prefix('/{user}/grades')->group(function () {

        //  Index
        Route::name('index')->get('/', [GradeController::class, 'index']);

        //  Store
        Route::name('store')->post('/store', [GradeController::class, 'store']);

});
