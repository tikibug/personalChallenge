<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneListController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/genes', [GeneListController::class, 'index']);

