<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/users', [UserController::class, 'index']);
use App\Http\Controllers\Api\ClassController;

Route::get('/classes', [ClassController::class, 'index']);
use App\Http\Controllers\GiftController;
use App\Http\Controllers\GiftRequestController;

Route::apiResource('gifts', GiftController::class);
Route::apiResource('gift-requests', GiftRequestController::class);

// رابط خاص للخادم ليرى طلبات فصله
Route::get('/class-gift-requests', [GiftRequestController::class, 'classRequests'])->middleware('auth');

// Subscription API routes
Route::middleware('auth')->group(function () {
    Route::get('/subscriptions/check-status', [\App\Http\Controllers\API\SubscriptionController::class, 'checkStatus']);
    Route::get('/subscriptions/my', [\App\Http\Controllers\API\SubscriptionController::class, 'mySubscriptions']);
    Route::post('/subscriptions', [\App\Http\Controllers\API\SubscriptionController::class, 'store']);
    Route::get('/subscriptions', [\App\Http\Controllers\API\SubscriptionController::class, 'index']);
    Route::put('/subscriptions/{subscription}/status', [\App\Http\Controllers\API\SubscriptionController::class, 'updateStatus']);
});