<?php

use Illuminate\Support\Facades\Route;
use MongoDB\Client;

Route::get('/test-mongodb-connection', function () {
    try {
        $connection = new Client("mongodb://127.0.0.1:27017");
        $database = $connection->selectDatabase('kendaraan');
        $collection = $database->selectCollection('users');
        $collection->findOne();
        return "Koneksi MongoDB berhasil!";
    } catch (\Exception $e) {
        return "Koneksi MongoDB gagal: " . $e->getMessage();
    }
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/test', function () {
    return 'Ini halaman test';
});

Route::get('/kendaraan', 'App\Http\Controllers\KendaraanController@index');

Route::get('/kendaraan/{id}', 'App\Http\Controllers\KendaraanController@show');

Route::post('/kendaraan', 'App\Http\Controllers\KendaraanController@store')->middleware('auth');

Route::put('/kendaraan/{id}', 'App\Http\Controllers\KendaraanController@update')->middleware('auth');

Route::delete('/kendaraan/{id}', 'App\Http\Controllers\KendaraanController@destroy')->middleware('auth');
