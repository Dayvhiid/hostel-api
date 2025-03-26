<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/register', [AuthController::class,'register'])->name('register');
Route::post('login', [AuthController::class,'login'])->name('login');



Route::middleware('auth:sanctum')->group(function () {
   Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware(['auth:sanctum', 'role:admin'])->group(function (){
    Route::get('/admin', function(){
        return response()->json(['message' => 'Admin Logged In Succesfully']);
    });
});

Route::middleware(['auth:sanctum', 'role:student'])->group(function(){
    Route::get('/student', function(){
        return response()->json(['message' => 'Student Logged In Succesfully']);
    });
});

Route::middleware(['auth:sanctum', 'role:manager'])->group(function(){
    Route::get('/manager', function(){
        return response()->json(['message' => 'Manager Logged In Succesfully']);
    });
});
