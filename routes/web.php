<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\DeportistaController;

// RUTAS PÚBLICAS (sin login)
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// RUTAS PROTEGIDAS (requieren login)
// Los controladores ya tienen la protección en el constructor
Route::resource('pais', PaisController::class);
Route::resource('disciplina', DisciplinaController::class);
Route::resource('deportistas', DeportistaController::class);