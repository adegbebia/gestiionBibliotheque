<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LecteurController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'home'])->name('home');


Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth')->name('dashboard');


Route::get('/login', [LoginController::class, 'login'])->name('login.form');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login'); 
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/inscription', [RegisterController::class, 'showRegistrationForm'])->name('lecteurs.register');
Route::post('/inscription', [RegisterController::class, 'register']);


Route::middleware('auth')->group(function () {
    Route::get('/livres', [LivreController::class, 'index'])->name('livres.index');
    Route::resource('livres', LivreController::class)->except(['index']);
    Route::resource('users', UserController::class);
    Route::resource('lecteurs', LecteurController::class);
    Route::resource('emprunts', EmpruntController::class);
});
