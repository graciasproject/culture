<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangueController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\TypeContenuController;
use App\Http\Controllers\TypeMediaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatsboardController;

// Routes protégées - UTILISEZ 'auth' au lieu de 'auth.custom'
Route::middleware(['auth'])->group(function () {

    // Page d'accueil authentifiée
    Route::get('/home-auth', [HomeController::class, 'index'])->name('home.auth');

    // Tableaux de bord
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/statsboard', [StatsboardController::class, 'index'])->name('statsboard');

    // Routes ressources
    Route::resource('users', UserController::class);
    Route::resource('contenus', ContenuController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('langues', LangueController::class);
    Route::resource('medias', MediaController::class);
    Route::resource('commentaires', CommentaireController::class);
    Route::resource('types-contenu', TypeContenuController::class)->except(['create', 'show', 'edit']);
    Route::resource('types-media', TypeMediaController::class)->except(['create', 'show', 'edit']);

    // Route supplémentaire pour la modération
    Route::post('/contenus/{contenu}/moderer', [ContenuController::class, 'moderer'])->name('contenus.moderer');
});
