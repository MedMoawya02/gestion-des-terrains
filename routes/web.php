<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

//authentification routes
Route::get('/', [RegisterController::class,'index'])->name('register.index');
