<?php

use App\Http\Controllers\AuthCheckController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BmiRecordController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::get('/hitung', function () {
//     return redirect('home.bmi.section');
// })->name('hitung');

// Route::get('/tentang', function () {
//     return redirect('home.tentang.section');
// })->name('tentang');

//result
Route::get('/result-bmi', function () {
    return view('result');
})->name('result');
Route::get('/komunitas', function () {
    return view('komunitas');
})->name('komunitas');

//bmi route
Route::get('/bmi', [BmiRecordController::class, 'showForm'])->name('bmi.form'); // Menggunakan metode showForm untuk memuat form dengan data pengguna
Route::post('/bmi/calculate', [BmiRecordController::class, 'calculate'])->name('bmi.calculate'); // Tetap seperti sebelumnya

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

Route::get('/bmi', [BmiRecordController::class, 'showForm'])->name('bmi.form');
Route::post('/bmi/calculate', [BmiRecordController::class, 'calculate'])->name('bmi.calculate');

Route::get('/bmi/result', [BmiRecordController::class, 'showResult'])->name('bmi.result');
// Route::get('/progress', function () {
//     return view('progress'); // Blade untuk grafik progress
// })->name('progress.graph');

//route group user login == true
Route::middleware(['auth'])->group(
    function () {
        Route::get('/account', function () {
            return view('account');
        })->name('account');
        Route::get('/account', [BmiRecordController::class, 'getLatestBmiRecords'])->name('account');

        // logout
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        // route bmi
        Route::post('/bmi/save', [BmiRecordController::class, 'saveBmiRecord'])->name('save-bmi');
        Route::get('/progress', [BmiRecordController::class, 'showProgress'])->name('progress');
        Route::get('/filter-bmi/{period}', [BmiRecordController::class, 'filterBmi']);


        // edit profile
        Route::get('/profile/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/profile/update', [UserController::class, 'update'])->name('users.update');

        // route task
        Route::get('/profile/todo', function () {
            return view('user.todo');
        })->name('todo');
        Route::get('/todo', [TaskController::class, 'index'])->name('todo.index');
        // With this route
        Route::get('/profile/todo', [TaskController::class, 'show'])->name('todo');
        // show task
        Route::get('/todo', [TaskController::class, 'show'])->name('todo.show');
        // create task
        Route::get('/todo/create', [TaskController::class, 'create'])->name('todo.create');
        Route::post('/todo', [TaskController::class, 'store'])->name('todo.store');

        // Update status task
        Route::post('/todo/{task}/update-status', [TaskController::class, 'updateStatus'])->name('todo.updateStatus');

        // create task progress pada tugas
        Route::post('/todo/{task}/add-progress', [TaskController::class, 'addProgress'])->name('todo.addProgress');
    }

);
