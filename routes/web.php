<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneSearchController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/genes', [GeneSearchController::class, 'index']);

