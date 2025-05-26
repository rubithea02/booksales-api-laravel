<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Public route (bisa diakses tanpa autentikasi)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Logout butuh autentikasi
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Books: index & show untuk publik
Route::apiResource('books', BookController::class)->only(['index', 'show']);

// Authors: index & show untuk publik
Route::apiResource('authors', AuthorController::class)->only(['index', 'show']);

// Genres: index & show untuk publik
Route::apiResource('genres', GenreController::class)->only(['index', 'show']);

// Group middleware auth dan role admin untuk operasi create, update, destroy
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    // Books create, update, destroy
    Route::apiResource('books', BookController::class)->only(['store', 'update', 'destroy']);

    // Authors create, update, destroy
    Route::apiResource('authors', AuthorController::class)->only(['store', 'update', 'destroy']);

    // Genres create, update, destroy
    Route::apiResource('genres', GenreController::class)->only(['store', 'update', 'destroy']);
});
