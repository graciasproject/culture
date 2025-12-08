<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\LangueController;
use App\Http\Controllers\TypeMediaController;
use App\Http\Controllers\TypeContenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Inclusion des routes d'authentification
require __DIR__ . '/auth.php';

// ======================================================================
// 1. ROUTES PUBLIQUES (Guest)
// ======================================================================
Route::get('/', [HomeController::class, 'home'])->name('home');

// ======================================================================
// 2. ROUTES LECTEURS (Auth - Accessible à tous les connectés)
// ======================================================================
Route::middleware(['auth'])->group(function () {
    
    // Accueil Connecté
    Route::get('/home-auth', [HomeController::class, 'index'])->name('home.auth');

    // --- VUES PUBLIQUES (Consultation) ---
    // Ces routes servent à afficher les pages "Netflix style" ou les détails pour le lecteur
    
    Route::get('/contenus', [ContenuController::class, 'index'])->name('contenus.index');
    Route::get('/contenus/{contenu}', [ContenuController::class, 'show'])->name('contenus.show')->whereNumber('contenu');

    Route::get('/regions', [RegionController::class, 'index'])->name('regions.index');
    Route::get('/regions/{region}', [RegionController::class, 'show'])->name('regions.show');

    Route::get('/langues', [LangueController::class, 'index'])->name('langues.index');
    Route::get('/langues/{langue}', [LangueController::class, 'show'])->name('langues.show');
    
    // --- ACTIONS ---
    Route::post('/payment/pay/{contenu}', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
    
    // --- PROFIL ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ======================================================================
// 3. ROUTES ADMIN (Auth + Role 1)
// ======================================================================
Route::middleware(['auth', 'admin']) // Vérifie Auth ET Role 1
    ->prefix('admin')                // Ajoute "/admin" devant l'URL
    ->name('admin.')                 // Ajoute "admin." devant le nom de la route (ex: admin.regions.create)
    ->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/stats/refresh', [AdminController::class, 'refreshStats'])->name('stats.refresh');

    // CRUDs GESTION
    // Route::resource crée automatiquement : index, create, store, show, edit, update, destroy
    // Avec le préfixe 'admin.', cela donne : admin.regions.index, admin.regions.create, etc.
    
    Route::resource('contenus', ContenuController::class); // admin.contenus.index = Le Tableau de gestion
    Route::resource('regions', RegionController::class);   // admin.regions.index
    Route::resource('langues', LangueController::class);
    Route::resource('users', UserController::class);
    Route::resource('medias', MediaController::class);
    Route::resource('types-contenu', TypeContenuController::class);
    Route::resource('types-media', TypeMediaController::class);
    
    // Commentaires (juste liste et suppression)
    Route::resource('commentaires', CommentaireController::class)->only(['index', 'destroy']);
});

// ======================================================================
// 4. REDIRECTION INTELLIGENTE
// ======================================================================
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->id_role === 1) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home.auth');
})->name('dashboard');

Route::get('/setup-seeds-secret', function () {
    try {
        // On lance le seeder en forçant l'exécution (car on est en prod)
        Artisan::call('db:seed', ['--force' => true]);
        
        return 'Succès ! La base de données a été remplie.';
    } catch (\Exception $e) {
        return 'Erreur : ' . $e->getMessage();
    }
});