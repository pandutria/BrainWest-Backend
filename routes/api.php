<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth
Route::post("/register", [UserController::class, 'register']);
Route::post("/login", [UserController::class, 'login']);

Route::middleware("auth")->group(function() {
    Route::get("/me", [UserController::class, 'me']);

    // Education
    Route::get("/education", [EducationController::class, "index"]);
    Route::post("/education", [EducationController::class, "store"]);
    Route::get("/education/{id}", [EducationController::class, "show"]);
    Route::put("/education/{id}", [EducationController::class, "update"]);
    Route::delete("/education/{id}", [EducationController::class, "destroy"]);
});
