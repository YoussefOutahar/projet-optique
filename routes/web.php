<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\EyeDetailController;
use App\Models\Vente;

Route::get('/dashboard', function () {
    //return view('dashboard');
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('clients/{id}/eye-history', [ClientController::class, 'eyeHistory'])->name('clients.eyeHistory');

    Route::resource('fournisseurs', FournisseurController::class);
    Route::resource('produits', ProduitController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('ventes', VenteController::class);
    Route::resource('factures', FactureController::class);
    Route::resource('receptions', ReceptionController::class);
    Route::resource('caisses', CaisseController::class);
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/{client}/eye-details/{date}', [ClientController::class, 'showEyeDetailsByDate'])->name('clients.eyeDetailsByDate');
    
    Route::get('/ventes/client/{clientId}', [VenteController::class, 'getVenteByClient']);

    Route::get('clients/{client}/eyes', [ClientController::class, 'showEyesForm'])->name('clients.eyes'); // Pour ajouter ou modifier les données des yeux
    Route::put('/clients/{client}/eyes', [ClientController::class, 'updateEyes'])->name('clients.updateEyes');
    Route::get('clients/{client}/eye-details', [ClientController::class, 'showEyeDetails'])->name('clients.eyeDetails'); // Pour voir les détails des yeux
    Route::post('/receptions', [ReceptionController::class, 'store'])->name('receptions.store');

    Route::get('/clients/{client}/eyes/create', [EyeDetailController::class, 'create'])->name('clients.eyes.create');
    Route::post('/clients/{client}/eyes', [EyeDetailController::class, 'store'])->name('clients.eyes.store');
    Route::get('/factures/{id}/print', [FactureController::class, 'print'])->name('factures.print');
    Route::get('/factures', [FactureController::class, 'index'])->name('factures.index');
    Route::get('/caisses/create', [FactureController::class, 'createCaisse'])->name('caisses.create');
    Route::post('/caisses', [FactureController::class, 'storeCaisse'])->name('caisses.store');
    Route::get('/caisses/{id}', [FactureController::class, 'showCaisse'])->name('caisses.show');
    Route::get('/caisses/{id}/edit', [FactureController::class, 'editCaisse'])->name('caisses.edit');
    Route::put('/caisses/{id}', [FactureController::class, 'updateCaisse'])->name('caisses.update');
    Route::delete('/caisses/{id}', [FactureController::class, 'destroyCaisse'])->name('caisses.destroy');

    Route::get('clients/{client}/eyes', [EyeDetailController::class, 'show'])->name('clients.eyeDetails');
    Route::post('clients/{client}/eyes', [EyeDetailController::class, 'store'])->name('clients.eyes.store');
    
    Route::post('/ventes/save_and_continue', [VenteController::class, 'saveAndContinue'])->name('ventes.save_and_continue');
    Route::get('/ventes/categorie_reference/{vente}', [VenteController::class, 'categorieReference'])->name('ventes.categorie_reference');
    Route::post('/ventes/update_categorie_reference/{vente}', [VenteController::class, 'updateCategorieReference'])->name('ventes.update_categorie_reference');
    Route::post('/ventes/categorie_reference/{vente}', [VenteController::class, 'updateCategorieReference'])->name('ventes.updateCategorieReference');
    Route::get('ventes/categorie_reference/{vente}', [VenteController::class, 'showCategorieReference'])->name('ventes.categorie_reference');
    Route::get('ventes/categorie_reference/{venteId}', [VenteController::class, 'categorieReference'])->name('ventes.categorie_reference');
    
    Route::post('ventes/updateCategorieReference/{venteId}', [VenteController::class, 'updateCategorieReference'])->name('ventes.updateCategorieReference');
    
    Route::get('/ventes/{vente}/editCategorieReference', [VenteController::class, 'editCategorieReference'])->name('ventes.editCategorieReference');

    Route::get('/clients/{client}/eyes', [ClientController::class, 'showEyeDetails'])->name('clients.eyes');

    Route::get('/factures', [FactureController::class, 'index'])->name('factures.index');

    
    Route::get('/ventes/client/{client_id}', function($client_id) {
    $vente = Vente::where('client_id', $client_id)->latest()->first();
    return response()->json(['vente' => $vente]);
});

});

require __DIR__.'/auth.php';
