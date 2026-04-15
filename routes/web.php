<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReservationController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login.check');
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'register'])->name('register.register');
Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout')->middleware('auth');


Route::middleware('auth')->group(function () {
    /* --- Espace ADMIN --- */
    Route::middleware(AdminMiddleware::class)->group(function () {
        // Dashboard & Statistiques
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/calendrier', [AdminController::class, 'calendrier'])->name('calendrier');

        // Gestion des Terrains
        Route::prefix('terrains')->group(function () {
            Route::get('/', [AdminController::class, 'allTerrains'])->name('tousTerrain');
            Route::get('/creer', [AdminController::class, 'create'])->name('createTerrain');
            Route::post('/stocker', [AdminController::class, 'store'])->name('ajouterTerrain');
            Route::put('/{id}', [AdminController::class, 'update'])->name('modifierTerrain');
            Route::post('/supprimer/{id}', [AdminController::class, 'destroy'])->name('deleteTerrain');
        });
        // Gestion des Réservations & Export
        Route::get('/historique', [AdminController::class, 'allReservation'])->name('historique');
        Route::get('/reservations/export', [ReservationController::class, 'export'])->name('admin.reservations.export');
    });


    /* --- Espace CLIENT --- */
    Route::group([], function () {
        Route::get('/accueil', [ClientController::class, 'index'])->name('acceuil');
        Route::get('/a-propos', [ClientController::class, 'aboutPage'])->name('propos');

        // Réservations Client
        Route::get('/reserver-terrain', [ReservationController::class, 'reservationPage'])->name('reservation');
        Route::post('/reserver', [ReservationController::class, 'store'])->name('createReservation');
        Route::get('/mes-reservations', [ReservationController::class, 'mesReservations'])->name('mesReservations');
    });

});