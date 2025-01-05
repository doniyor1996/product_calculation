<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api.'], function () {
    Route::post('/login', [LoginController::class, 'index'])
        ->middleware('throttle:3,1')
        ->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('materials', MaterialController::class);

    Route::post('/logout', [LoginController::class, 'logout'])
        ->middleware('throttle:3,1')
        ->name('logout');
});
