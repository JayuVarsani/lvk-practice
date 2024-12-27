<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\PurchaseOrderController;

Route::group(['middleware' => 'PreventBack'], function () {

    Route::get('/', [AuthController::class, 'login'])->name('login')->middleware(['IsAdmin']);
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::post('/', [AuthController::class, 'loginPost'])->name('login.post');
        Route::get('/password/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
        Route::post('/password/forgot-password', [AuthController::class, 'forgotPasswordPost'])->name('password.email');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::group(['middleware' => 'auth:admin'], function () {
            Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

            Route::resource('moderator', ModeratorController::class);
            Route::group(['prefix' => 'purchase', 'as' => 'purchase.'], function () {
                Route::get('/', [PurchaseOrderController::class, 'index'])->name('purchase-order');
            });

            Route::group(['prefix' => 'purchase', 'as' => 'purchase.'], function () {
                Route::get('/', [PurchaseOrderController::class, 'index'])->name('purchase-order');
                Route::get('/export', [PurchaseOrderController::class, 'export'])->name('export');
            });


            Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
                Route::get('/', [ProfileController::class, 'index'])->name('index');
                Route::post('/', [ProfileController::class, 'update_profile'])->name('update-profile');
                Route::get('/change-password', [ProfileController::class, 'render'])->name('change-password');
                Route::post('/change-password', [ProfileController::class, 'change_password'])->name('change-password.post');
            });

        });

    });
    Route::get('/password/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('/password/reset-password', [AuthController::class, 'resetPasswordPost'])->name('password.update');
});
