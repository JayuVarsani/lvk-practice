<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers;
use App\Http\Controllers\AuthController;

Route::redirect('/', '/admin');
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [AuthController::class, 'login'])->name('login.index');
    Route::post('/', [AuthController::class, 'loginPost'])->name('login.post');
    Route::get('/password/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
    Route::post('/password/forgot-password', [AuthController::class, 'forgotPasswordPost'])->name('password.email');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
    Route::get('/password/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('/password/reset-password', [AuthController::class, 'resetPasswordPost'])->name('password.update');


