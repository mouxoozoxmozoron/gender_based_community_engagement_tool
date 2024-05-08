<?php

use App\Http\Controllers\API\advocacy_group\group_controller;
use App\Http\Controllers\API\advocacy_group\group_member_controller;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\booking\booking_controller;
use App\Http\Controllers\API\Comments\CommentController;
use App\Http\Controllers\API\event\event_contoller;
use App\Http\Controllers\API\Index\AppIndexController;
use App\Http\Controllers\API\Likes\LIkesController;
use App\Http\Controllers\API\Posters\PosterController;
use App\Http\Controllers\API\Replies\ReplieController;
use App\Http\Controllers\API\users\UserController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//here let authenticate the user now to be able to acces auth roytes
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout/{userId}', [AuthController::class, 'logout']);
});

Route::post('register', [UserController::class, 'register']);
Route::GET('gbcehome', [AppIndexController::class, 'HomeContent']);
Route::GET('Profile/{userid}', [AppIndexController::class, 'Profiles']);

//Athenticated routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('posts', PosterController::class);
    Route::resource('Comments', CommentController::class);
    Route::resource('Replies', ReplieController::class);
    Route::resource('Likes', LIkesController::class);
    Route::resource('group', group_controller::class);
    Route::resource('group_member', group_member_controller::class);
    Route::resource('event', event_contoller::class);
    Route::resource('booking', booking_controller::class);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
