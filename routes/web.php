<?php

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

//account
Route::get('/account', function () {
    return view('account');
})->name('account');
