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
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourBookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/auth/reset-password', [AuthController::class, 'resetPassword']);
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/profile', [\App\Http\Controllers\ProfileController::class, 'update']);
});

// Room Management (Public Lists)
Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);

// Booking & Availability (Public)
Route::post('/bookings', [BookingController::class, 'store']); // Create booking
Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);
Route::post('/create-tour-payment-intent', [PaymentController::class, 'createTourPaymentIntent']);

// Content (Public Lists)
Route::get('/slides', [SlideController::class, 'index']);
Route::get('/amenities', [AmenityController::class, 'index']);
Route::get('/places', [PlaceController::class, 'index']);
Route::get('/activities', [ActivityController::class, 'index']);
Route::get('/service-values', [ServiceValueController::class, 'index']);
Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/settings', [SettingController::class, 'index']); // Public settings? Spec says "Admin" usually but GET might be public for frontend

// Tours (Public Lists)
Route::get('/tours', [TourController::class, 'index']);
Route::get('/tours/{id}', [TourController::class, 'show']);

// Tour Bookings (Public Create)
Route::post('/tour-bookings', [TourBookingController::class, 'store']);

// Interactive (Public)
Route::post('/inquiries', [InquiryController::class, 'store']);
Route::post('/newsletter', [NewsletterController::class, 'store']);

// Protected Admin Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/admin/dashboard-stats', [\App\Http\Controllers\DashboardController::class, 'stats']);

    // Room Management (Admin)
    Route::post('/rooms', [RoomController::class, 'store']);
    Route::post('/rooms/{id}', [RoomController::class, 'update']);
    Route::put('/rooms/{id}', [RoomController::class, 'update']);
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);

    // Booking Management (Admin)
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::put('/bookings/{id}/status', [BookingController::class, 'updateStatus']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']); // Cancel booking

    // Content Management (Admin)
    Route::post('/slides/{id}', [SlideController::class, 'update']);
    Route::apiResource('slides', SlideController::class)->only(['store', 'update', 'destroy']);
    Route::post('/amenities/{id}', [AmenityController::class, 'update']);
    Route::apiResource('amenities', AmenityController::class)->only(['store', 'update', 'destroy']);
    Route::post('/places/{id}', [PlaceController::class, 'update']);
    Route::apiResource('places', PlaceController::class)->only(['store', 'update', 'destroy']);
    Route::post('/activities/{id}', [ActivityController::class, 'update']);
    Route::apiResource('activities', ActivityController::class)->only(['store', 'update', 'destroy']);
    Route::post('/service-values/{id}', [ServiceValueController::class, 'update']);
    Route::apiResource('service-values', ServiceValueController::class)->only(['store', 'update', 'destroy']);
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::post('/reviews/{id}', [ReviewController::class, 'update']);
    Route::put('/reviews/{id}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
    Route::post('/articles/{id}', [ArticleController::class, 'update']);
    Route::apiResource('articles', ArticleController::class)->only(['store', 'update', 'destroy']);

    // Tour Management (Admin)
    Route::post('/tours', [TourController::class, 'store']);
    Route::post('/tours/{id}', [TourController::class, 'update']);
    Route::put('/tours/{id}', [TourController::class, 'update']);
    Route::delete('/tours/{id}', [TourController::class, 'destroy']);

    // Tour Booking Management (Admin)
    Route::get('/tour-bookings', [TourBookingController::class, 'index']);
    Route::put('/tour-bookings/{id}/status', [TourBookingController::class, 'updateStatus']);
    Route::delete('/tour-bookings/{id}', [TourBookingController::class, 'destroy']);

    // Inquiries Management (Admin)
    Route::get('/inquiries', [InquiryController::class, 'index']);
    Route::put('/inquiries/{id}', [InquiryController::class, 'update']);
    Route::delete('/inquiries/{id}', [InquiryController::class, 'destroy']);

    // Newsletter (Admin View)
    Route::get('/newsletter', [NewsletterController::class, 'index']);

    // Settings (Admin Update)
    Route::post('/settings', [SettingController::class, 'update']);
});
