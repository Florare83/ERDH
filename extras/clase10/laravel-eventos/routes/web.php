<?php

use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/eventos');
});

Route::get('/eventos', [EventoController::class, 'index']);
Route::get('/api/eventos', [EventoController::class, 'api']);