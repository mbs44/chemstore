<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChemicalController;


Route::resource('chemicals', ChemicalController::class);

Route::get('/', function () {
    return view('welcome');
});
