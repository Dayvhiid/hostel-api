<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Login and Register (Accessible without authentication)
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);




    // Route::post('signup', [AuthController::class, 'signup'])->middleware('auth:sanctum');
    // Route::post('/login', [AuthController::class, 'login'])->middleware('auth:sanctum')->name('login'); 
    // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route::middleware('api')->group(function () {
    //     Route::post('/signup', [AuthController::class, 'signup']);
    //     Route::post('/login', [AuthController::class, 'login']);
    // });



// Routes that require authentication
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Role-based routes
    Route::middleware(['role:admin'])->get('/admin', function () {
        return response()->json(['message' => 'Admin Logged In Successfully']);
    });

    Route::middleware(['role:student'])->get('/student', function () {
        return response()->json(['message' => 'Student Logged In Successfully']);
    });

    Route::middleware(['role:manager'])->get('/manager', function () {
        return response()->json(['message' => 'Manager Logged In Successfully']);
    });
});
