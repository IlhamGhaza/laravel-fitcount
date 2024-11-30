<?php

use App\Http\Controllers\AuthCheckController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/hitung', function () {
    return redirect('hitung')->fragment('hitung.section');
})->name('hitung');
Route::get('/tentang', function () {
    return redirect('tentang')->fragment('tentang.section');
})->name('tentang');

//result
Route::get('/result-bmi', function () {
    return view('result');
})->name('result');
Route::get('/komunitas', function () {
    return view('komunitas');
})->name('komunitas');

// check auth status
Route::get('/check-auth', [AuthCheckController::class, 'checkAuth'])->name('check.auth');
Route::get('/check-auth2', [AuthCheckController::class, 'checkAuth2'])->name('check.auth2');

// Login Routes...
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Registration Routes...
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Password Reset Routes...
Route::get('forgot-password', [AuthController::class, 'showResetPasswordForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'resetPassword'])->name('password.email');

//
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');

//route group user login == true
Route::middleware(['auth'])->group(function () {
    Route::get('/account', function () {
        return view('account');
    })->name('account');
    // logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    // edit profile
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/profile/update', [UserController::class, 'update'])->name('users.update');
    //route todo
    Route::get('/profile/todo', function () {
        return view('user.todo');
    })->name('todo');
    // Route::post('/profile/todo', [UserController::class, 'storeTodo'])->name('todo.store');
});
