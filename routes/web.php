<?php

use App\Http\Controllers\AuthCheckController;
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

Route::get('/check-auth', [AuthCheckController::class, 'checkAuth'])->name('check.auth');

