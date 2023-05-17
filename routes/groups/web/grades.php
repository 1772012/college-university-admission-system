<?php

use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;

Route::name('grades.')
    ->prefix('/grades')
    ->group(function () {

        //  Index
        Route::name('index')
            ->get('/', [GradeController::class, 'index']);

        //  Store
        Route::name('store')
            ->post('/store', [GradeController::class, 'store']);

        //  Update
        Route::name('update')
            ->post('/update', [GradeController::class, 'update']);

});
