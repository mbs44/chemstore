<?php

use App\Http\Controllers\ExperimentController;
use App\Http\Controllers\RequestActionsController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChemicalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\LanguageController;

Route::post('/language', [LanguageController::class, 'change'])->name('language.change');

Route::resource('chemicals', ChemicalController::class)->middleware('auth');
Route::resource('experiments', ExperimentController::class)->middleware('auth');
Route::resource('requests', RequestController::class)->middleware('auth');

Route::resource('users', UserController::class)->middleware('auth');

Route::post('/approve-request', [RequestActionsController::class, 'approve'])->name('request.approve')->middleware('auth');
Route::post('/cancel-request', [RequestActionsController::class, 'cancel'])->name('request.cancel')->middleware('auth');
Route::post('/process-request', [RequestActionsController::class, 'process'])->name('request.process')->middleware('auth');


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//// Protected route
//Route::get('/home', function () {
//    return view('home'); // Your home view
//})->middleware('auth'); // This middleware ensures the user is authenticated
