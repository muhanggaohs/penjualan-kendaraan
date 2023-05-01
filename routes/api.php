<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KendaraanController;

// Authentication routes
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'getUser']);

// Kendaraan routes
Route::middleware('auth:sanctum')->get('/kendaraan', [KendaraanController::class, 'index']);
Route::middleware('auth:sanctum')->get('/kendaraan/{id}', [KendaraanController::class, 'show']);
Route::middleware('auth:sanctum')->post('/kendaraan', [KendaraanController::class, 'store']);
Route::middleware('auth:sanctum')->put('/kendaraan/{id}', [KendaraanController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/kendaraan/{id}', [KendaraanController::class, 'destroy']);
