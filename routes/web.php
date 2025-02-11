<?php

use App\Http\Controllers\ExperimentController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChemicalController;
use App\Http\Controllers\HomeController;

Route::resource('chemicals', ChemicalController::class);
Route::resource('experiments', ExperimentController::class);
Route::resource('requests', RequestController::class);

Route::get('/', [HomeController::class, 'index'])->name('home');
