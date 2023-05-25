<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->name('dashboard.')->prefix('/dashboard')->group(function () {

    //  Index
    Route::name('index')->get('/', [DashboardController::class, 'index']);

    //  Chart study program applications
    Route::name('chart-study-program-applications')->get('/chart/study-program-applications', [DashboardController::class, 'chartStudyProgramApplications']);

    //  Chart accepted study program
    Route::name('chart-accepted-study-programs')->get('/chart/accepted-study-programs', [DashboardController::class, 'chartAcceptedStudyPrograms']);
});
