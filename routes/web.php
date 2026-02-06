<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

//authentification routes
Route::get('/register', [RegisterController::class,'index'])->name('register.index');
Route::post('/register/register', [RegisterController::class,'register'])->name('register.register');
Route::get('/', [LoginController::class,'index'])->name('login.index');
Route::post('/login', [LoginController::class,'login'])->name('login.check');
