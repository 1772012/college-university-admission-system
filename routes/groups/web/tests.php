<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->name('tests.')->prefix('/tests')->group(function () {

    //  Test
    Route::name('test')->get('/', [TestController::class, 'test']);
});
