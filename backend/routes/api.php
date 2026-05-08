<?php

use App\Http\Controllers\Api\AdminPharmacyController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PharmacistPharmacyController;
use App\Http\Controllers\Api\PublicSearchController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/auth/reset-password', [AuthController::class, 'resetPassword']);

Route::get('/medicines/search', [PublicSearchController::class, 'search']);
Route::get('/medicines/{medicine}', [PublicSearchController::class, 'showMedicine']);

Route::middleware('api.token')->group(function (): void {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::prefix('admin')
        ->middleware('role:manager')
        ->group(function (): void {
            Route::get('/users', [AdminUserController::class, 'index']);
            Route::post('/users', [AdminUserController::class, 'store']);
            Route::put('/users/{user}', [AdminUserController::class, 'update']);
            Route::delete('/users/{user}', [AdminUserController::class, 'destroy']);

            Route::get('/pharmacies', [AdminPharmacyController::class, 'index']);
            Route::post('/pharmacies', [AdminPharmacyController::class, 'store']);
            Route::put('/pharmacies/{pharmacy}', [AdminPharmacyController::class, 'update']);
            Route::delete('/pharmacies/{pharmacy}', [AdminPharmacyController::class, 'destroy']);
            Route::put('/pharmacies/{pharmacy}/pharmacists', [AdminPharmacyController::class, 'syncPharmacists']);
        });

    Route::prefix('pharmacist')
        ->middleware('role:pharmacist')
        ->group(function (): void {
            Route::get('/pharmacies', [PharmacistPharmacyController::class, 'myPharmacies']);
            Route::put('/pharmacies/{pharmacy}', [PharmacistPharmacyController::class, 'updatePharmacyInfo']);
            Route::post('/pharmacies/{pharmacy}/availability', [PharmacistPharmacyController::class, 'upsertAvailability']);
        });
});
