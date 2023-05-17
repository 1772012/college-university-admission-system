<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::name('login.')
    ->prefix('/')
    ->group(function () {

        //  Index
        Route::name('index')
            ->get('/', [LoginController::class, 'index']);

        //  Auth
        Route::name('auth')
            ->post('/auth', [LoginController::class, 'auth']);

        //  Logout
        Route::name('logout')
            ->post('/logout', [LoginController::class, 'logout']);

});
