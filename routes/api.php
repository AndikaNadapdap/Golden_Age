<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FacebookAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Facebook OAuth API
Route::prefix('auth/facebook')->group(function () {
    // Public routes
    Route::get('/login-url', [FacebookAuthController::class, 'getLoginUrl']);
    Route::post('/token', [FacebookAuthController::class, 'loginWithToken']);
    Route::post('/verify', [FacebookAuthController::class, 'verifyToken']);
    Route::get('/callback', [FacebookAuthController::class, 'handleCallback']);
    
    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [FacebookAuthController::class, 'me']);
        Route::post('/logout', [FacebookAuthController::class, 'logout']);
    });
});
