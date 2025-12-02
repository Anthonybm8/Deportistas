<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\DeportistaController;



Route::get('/', [PaisController::class, 'index']);


Route::resource('pais', PaisController::class);
Route::resource('disciplina', DisciplinaController::class);
Route::resource('deportistas', DeportistaController::class);
