<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ServiceValueController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/profile', [\App\Http\Controllers\ProfileController::class, 'update']);
});

// Room Management (Public Lists)
Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);

// Booking & Availability (Public)
Route::post('/bookings', [BookingController::class, 'store']); // Create booking
Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);

// Content (Public Lists)
Route::get('/slides', [SlideController::class, 'index']);
Route::get('/amenities', [AmenityController::class, 'index']);
Route::get('/places', [PlaceController::class, 'index']);
Route::get('/activities', [ActivityController::class, 'index']);
Route::get('/service-values', [ServiceValueController::class, 'index']);
Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/settings', [SettingController::class, 'index']); // Public settings? Spec says "Admin" usually but GET might be public for frontend

// Interactive (Public)
Route::post('/inquiries', [InquiryController::class, 'store']);
Route::post('/newsletter', [NewsletterController::class, 'store']);

// Protected Admin Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::get('/admin/dashboard-stats', [\App\Http\Controllers\DashboardController::class, 'stats']);

    // Room Management (Admin)
    Route::post('/rooms', [RoomController::class, 'store']);
    Route::put('/rooms/{id}', [RoomController::class, 'update']);
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);

    // Booking Management (Admin)
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::put('/bookings/{id}/status', [BookingController::class, 'updateStatus']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']); // Cancel booking

    // Content Management (Admin)
    // Assuming simple CRUD for these based on "Managed by Admin" in spec
    Route::apiResource('slides', SlideController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('amenities', AmenityController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('places', PlaceController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('activities', ActivityController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('service-values', ServiceValueController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('reviews', ReviewController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('articles', ArticleController::class)->only(['store', 'update', 'destroy']);
    
    // Inquiries & Newsletter (Admin View)
    Route::get('/inquiries', [InquiryController::class, 'index']);
    Route::get('/newsletter', [NewsletterController::class, 'index']);

    // Settings (Admin Update)
    Route::post('/settings', [SettingController::class, 'update']);
});
