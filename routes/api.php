<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\FacebookAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Google OAuth API
Route::prefix('auth')->group(function () {
    Route::get('/google/redirect', [GoogleAuthController::class, 'apiRedirectToGoogle']);
    Route::get('/google/callback', [GoogleAuthController::class, 'apiHandleGoogleCallback']);
    
    // Facebook OAuth API
    Route::get('/facebook/redirect', [FacebookAuthController::class, 'apiRedirectToFacebook']);
    Route::get('/facebook/callback', [FacebookAuthController::class, 'apiHandleFacebookCallback']);
});
