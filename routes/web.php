<?php

use App\Http\Controllers\AuthCheckController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/hitung', function () {
    return view('hitung');
})->name('hitung');
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');
Route::get('/komunitas', function () {
    return view('komunitas');
})->name('komunitas');
Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('profile');

// check auth status
Route::get('/check-auth', [AuthCheckController::class, 'checkAuth'])->name('check.auth');
Route::get('/check-auth2', [AuthCheckController::class, 'checkAuth2'])->name('check.auth2');

// login
// Route::get('/login', [AuthController::class, 'login'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login');

// register
// Route::get('/register', [AuthController::class, 'register'])->name('register');
// Route::post('/register', [AuthController::class, 'register'])->name('register');

//route group user login == true
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
