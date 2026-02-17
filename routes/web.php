<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

//authentification routes
Route::get('/register', [RegisterController::class,'index'])->name('register.index');
Route::post('/register/register', [RegisterController::class,'register'])->name('register.register');
Route::get('/', [LoginController::class,'index'])->name('login.index');
Route::post('/login', [LoginController::class,'login'])->name('login.check');
Route::post('/logout', [LoginController::class,'logout'])->name('login.logout');

// Admin
Route::get('/dashboard', [AdminController::class,'index'])->name('dashboard')->middleware(['auth',AdminMiddleware::class]);
Route::get('/terrains', [AdminController::class,'create'])->name('createTerrain')->middleware(['auth',AdminMiddleware::class]);
Route::post('/ajouterTerrain', [AdminController::class,'store'])->name('ajouterTerrain')->middleware(['auth',AdminMiddleware::class]);
Route::get('/tousTerrains', [AdminController::class,'allTerrains'])->name('tousTerrain')->middleware(['auth',AdminMiddleware::class]);
Route::put('/modifierTerrain/{id}', [AdminController::class,'update'])->name('modifierTerrain')->middleware(['auth',AdminMiddleware::class]);
Route::post('/supprimerTerrain/{id}', [AdminController::class,'destroy'])->name('deleteTerrain')->middleware(['auth',AdminMiddleware::class]);

//client
Route::get('/acceuil',[ClientController::class,'index'])->name('acceuil')->middleware('auth');
Route::get('/à propos',[ClientController::class,'aboutPage'])->name('propos')->middleware('auth');