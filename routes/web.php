<?php

use App\Http\Controllers\ExperimentController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChemicalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::resource('chemicals', ChemicalController::class)->middleware('auth');
Route::resource('experiments', ExperimentController::class)->middleware('auth');
Route::resource('requests', RequestController::class)->middleware('auth');;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//// Protected route
//Route::get('/home', function () {
//    return view('home'); // Your home view
//})->middleware('auth'); // This middleware ensures the user is authenticated
