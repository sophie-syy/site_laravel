<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MotDePasseController;


Route::get('/', [CompteController::class, 'home_index']);

Route::get('/creer', [CompteController::class, 'creer_index']);
Route::post('/creer', [CompteController::class, 'creer_parcel']);

Route::get('/connecter', [CompteController::class, 'connecter_index']);
Route::post('/connecter', [CompteController::class, 'connecter_parcel']);

Route::get('/admin', [AdminController::class, 'admin']);

Route::post('/admin/produit',[AdminController::class, 'storeProduit']);
Route::put('/admin/produit/{id}', [AdminController::class, 'updateProduit']);
Route::delete('/admin/produit/{id}', [AdminController::class, 'destroyProduit']);

Route::post('/admin/categorie', [AdminController::class, 'storeCategorie']);
Route::put('/admin/categorie/{id}', [AdminController::class, 'updateCategorie']);
Route::delete('/admin/categorie/{id}', [AdminController::class, 'destroyCategorie']);

Route::delete('/admin/client/{id}', [AdminController::class, 'destroyClient']);

Route::get('/compte', [CompteController::class, 'accueil']);
Route::put('/compte', [CompteController::class, 'modifier_infos']);
Route::post('/compte', [CompteController::class, 'deconnexion']);
Route::delete('/compte', [CompteController::class, 'supprimer_compte']);

Route::get('/menu', [MenuController::class, 'index']);

Route::get('/panier', [PanierController::class, 'index']);
Route::post('/panier/ajouter/{id}', [PanierController::class, 'ajouter']);
Route::delete('/panier/supprimer/{id}', [PanierController::class, 'supprimer']);
Route::delete('/panier/vider', [PanierController::class, 'vider']);

Route::post('/commande', [CommandeController::class, 'acheter']);


Route::get( '/mdpOublie', [MotDePasseController::class, 'afficherFormulaire']);
Route::post( '/mdpOublie', [MotDePasseController::class, 'envoyerLien']);
Route::get( '/mdpReinitialiser/{token}', [MotDePasseController::class, 'afficherReinitialisation']);
Route::post('/mdpReinitialiser', [MotDePasseController::class, 'reinitialiser']);

