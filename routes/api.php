<?php

use App\Http\Controllers\Api\DataExportController;
use App\Http\Controllers\Api\MedicalController;
use App\Http\Controllers\Api\SettingsController as ApiSettingsController;
use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Support\Facades\Route;

/*
   |--------------------------------------------------------------------------
   | API Routes
   |--------------------------------------------------------------------------
   |
   | Here is where you can register API routes for your application. These
   | routes are loaded by the RouteServiceProvider and all of them will
   | be assigned to the "api" middleware group. Make something great!
   |
   */

Route::middleware(['changeLanguage'])->group(function () {
    Route::controller(UserAuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('check-active', 'checkActive');
    });

    Route::get('settings', [ApiSettingsController::class, 'settings']);


    Route::prefix('medicins')->group(function () {
        Route::get('export-medicals', [DataExportController::class, 'export']);
        Route::get('/', [MedicalController::class, 'index']);
        Route::get('/{id}', [MedicalController::class, 'show']);
    });
});
