<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneController;
use App\Http\Controllers\GeneWelcomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gene-app', [GeneWelcomeController::class, 'index']);
Route::get('/genes/autocomplete', [GeneController::class, 'autocomplete']);
Route::resource('genes', GeneController::class)->only(['index', 'show']);


