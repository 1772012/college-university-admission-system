<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->name('users.')->prefix('/users')->group(function () {

    //  Index
    Route::name('index')->get('/', [UserController::class, 'index']);

    //  Create
    Route::name('create')->get('/create', [UserController::class, 'create']);

    //  Edit
    Route::name('edit')->get('/{user}/edit', [UserController::class, 'edit']);

    //  Datatables
    Route::name('datatables')->get('/datatables', [UserController::class, 'datatables']);

    //  Store
    Route::name('store')->post('/store', [UserController::class, 'store']);

    //  Update
    Route::name('update')->post('/{user}/update', [UserController::class, 'update']);

    //  Destroy
    Route::name('destroy')->post('/{user}/destroy', [UserController::class, 'destroy']);
});
