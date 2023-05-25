<?php

use App\Http\Controllers\FacultyController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->name('faculties.')->prefix('/faculties')->group(function () {

    //  Index
    Route::name('index')->get('/', [FacultyController::class, 'index']);

    //  Datatables
    Route::name('datatables')->get('/datatables', [FacultyController::class, 'datatables']);
});
