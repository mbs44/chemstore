<?php

use App\Http\Controllers\ExperimentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChemicalController;
use App\Http\Controllers\HomeController;

Route::resource('chemicals', ChemicalController::class);
Route::resource('experiments', ExperimentController::class);

Route::get('/', [HomeController::class, 'index'])->name('home');
