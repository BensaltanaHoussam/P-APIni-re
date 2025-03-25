<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);



    // Public routes for viewing
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    Route::get('plants', [PlantController::class, 'index']);
    Route::get('plants/slug/{slug}', [PlantController::class, 'showBySlug']);
    Route::get('plants/{plant}', [PlantController::class, 'show']);



    Route::middleware('admin')->group(function () {
        // Categories management
        Route::post('categories', [CategoryController::class, 'store']);
        Route::put('categories/{category}', [CategoryController::class, 'update']);
        Route::delete('categories/{category}', [CategoryController::class, 'destroy']);

        // Plants management
        Route::post('plants', [PlantController::class, 'store']);
        Route::put('plants/{plant}', [PlantController::class, 'update']);
        Route::delete('plants/{plant}', [PlantController::class, 'destroy']);

        // Statistics
        Route::get('statistics', [StatisticsController::class, 'index']);
    
    });



    Route::middleware('client')->group(function () {
        Route::post('orders', [OrderController::class, 'store']);
        Route::get('orders', [OrderController::class, 'index']);
        Route::get('orders/{order}', [OrderController::class, 'show']);
        Route::patch('orders/{id}/cancel', [OrderController::class, 'cancel']);
    }); 

    Route::middleware('employee')->group(function () {
        Route::get('orders/pending', [OrderController::class, 'listPendingOrders']);
        Route::patch('orders/{id}/prepare', [OrderController::class, 'markAsPrepared']);
    });


});
