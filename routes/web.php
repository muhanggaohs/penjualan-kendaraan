<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KendaraanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth.jwt']], function () {
    // Route::get('/dashboard', 'DashboardController@index');
    Route::get('/kendaraans', [KendaraanController::class, 'index']);
    Route::post('/kendaraans', [KendaraanController::class, 'store']);
    Route::get('/kendaraans/{id}', [KendaraanController::class, 'show']);
    Route::put('/kendaraans/{id}', [KendaraanController::class, 'update']);
    Route::delete('/kendaraans/{id}', [KendaraanController::class, 'destroy']);
});


// Route yang tidak memerlukan autentikasi
Route::get('/', function () {
    return view('welcome');
});

// Route yang memerlukan autentikasi menggunakan middleware 'jwt.auth'
Route::get('/protected', function () {
    return response()->json(['message' => 'This route requires authentication']);
})->middleware('jwt.auth');

