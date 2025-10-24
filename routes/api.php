<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommunityGroupController;
use App\Http\Controllers\CommunityGroupMemberController;
use App\Http\Controllers\CommunityGroupMessageController;
use App\Http\Controllers\ConsultationChatHistoriesController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\DonateTransactionController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTransactionDetailController;
use App\Http\Controllers\ProductTransactionHeaderController;
use App\Http\Controllers\RehabilitationController;
use App\Http\Controllers\RehabilitationVideoController;
use App\Http\Controllers\UserController;
use App\Models\CommunityGroup;
use App\Models\CommunityGroupMessage;
use App\Models\WebinarTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth
Route::post("/register", [UserController::class, 'register']);
Route::post("/login", [UserController::class, 'login']);

Route::middleware("auth:sanctum")->group(function() {
    Route::get("/me", [UserController::class, 'me']); // Me
    Route::get("/me/event/transaction", [EventTransactionController::class, 'meTransaction']); // Me Event Transaction
    Route::get("/me/donate/transaction", [DonateTransactionController::class, 'meTransaction']); // Me Donate Transaction

    Route::resource("/education", EducationController::class); // Education
    Route::resource("/events", EventController::class); // Event
    Route::resource("/event/transaction", EventTransactionController::class); // Event Transaction
    Route::resource("/donates", DonateController::class); // Donate
    Route::resource("/donate/transaction", DonateTransactionController::class); // Donate Transaction

    //Consultation
    Route::post('/consultation', [ConsultationChatHistoriesController::class, 'sendMessage']);
    Route::get('/consultation/history', [ConsultationChatHistoriesController::class, 'getHistory']);

    //Community
    Route::post('/community', [CommunityGroupController::class, 'store']);

    //Community Member
    Route::post('/community/member', [CommunityGroupMemberController::class, 'store']);

    //Community Message
    Route::post('/community/message', [CommunityGroupMessageController::class, 'sendMessage']);
    Route::get('/community/message/history', [CommunityGroupMessageController::class, 'getHistory']);

    //Transaction Hader
    Route::post('/product/transaction', [ProductTransactionHeaderController::class, 'store']);
});

//Doctor
Route::get('/doctor', [DoctorController::class, 'index']);
Route::get('/doctor/{id}', [DoctorController::class, 'show']);
Route::post('/doctor', [DoctorController::class, 'store']);
Route::delete('/doctor/{id}', [DoctorController::class, 'destroy']);

//Rehabilitation
Route::get('/rehabilitation', [RehabilitationController::class, 'index']);
Route::post('rehabilitation', [RehabilitationController::class, 'store']);
Route::delete('/rehabilitation/{id}', [RehabilitationController::class, 'destroy']);
Route::get('/rehabilitation/video/by-rehab/{id}', [RehabilitationVideoController::class, 'showByRehabid']);

//Rehabilitation Video
Route::get('/rehabilitation/video', [RehabilitationVideoController::class, 'index']);
Route::get('/rehabilitation/video/{id}', [RehabilitationVideoController::class, 'show']);
Route::post('rehabilitation/video', [RehabilitationVideoController::class, 'store']);
Route::delete('/rehabilitation/video/{id}', [RehabilitationVideoController::class, 'destroy']);
Route::post('/rehabilitation/video/by-rehab', [RehabilitationVideoController::class, 'indexByRehabId']);

//Community
Route::get('/community', [CommunityGroupController::class, 'index']);
Route::get('/community/{id}', [CommunityGroupController::class, 'show']);
Route::delete('/community/{id}', [CommunityGroupController::class, 'destroy']);
Route::post('/rehabilitation/video/by-rehab', [RehabilitationVideoController::class, 'indexByRehabId']);

//Product
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::post('/product', [ProductController::class, 'store']);


//Transaction Hader
Route::get('/product/transaction', [ProductTransactionHeaderController::class, 'index']);

//Transaction Detail
Route::get('/product/transaction/detail', [ProductTransactionDetailController::class, 'index']);
Route::post('/product/transaction/detail', [ProductTransactionDetailController::class, 'store']);
