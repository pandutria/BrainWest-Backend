<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth
Route::post("/register", [UserController::class, 'register']);
Route::post("/login", [UserController::class, 'login']);

Route::middleware("auth")->group(function() {
    Route::get("/me", [UserController::class, 'me']);

    // Education
    Route::get("/article", [ArticleController::class, "index"]);
    Route::post("/article", [ArticleController::class, "store"]);
    Route::get("/article/{id}", [ArticleController::class, "show"]);
    Route::put("/article/{id}", [ArticleController::class, "update"]);
    Route::delete("/article/{id}", [ArticleController::class, "destroy"]);
});
