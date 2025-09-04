<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTransactionController;
use App\Http\Controllers\UserController;
use App\Models\WebinarTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth
Route::post("/register", [UserController::class, 'register']);
Route::post("/login", [UserController::class, 'login']);

Route::middleware("auth")->group(function() {
    Route::get("/me", [UserController::class, 'me']); // Me
    Route::get("/me/event/transaction", [EventTransactionController::class, 'meTransaction']); // Me Event Transaction
    
    Route::resource("/education", EducationController::class); // Education        
    Route::resource("/event", EventController::class); // Event
    Route::resource("/event/transaction", EventTransactionController::class); // Event Transaction
});
