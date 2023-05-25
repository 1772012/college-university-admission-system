<?php

use App\Http\Controllers\APIControllers\StudyProgramController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->name('study-programs.')->prefix('/study-programs')->group(function () {

    //  Fetch
    Route::name('fetch')->get('/{faculty}/fetch', [StudyProgramController::class, 'fetch']);

    //  Search
    Route::name('search')->get('/search', [StudyProgramController::class, 'search']);
});
