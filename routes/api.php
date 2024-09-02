<?php

use App\Models\Inventario;
use Illuminate\Support\Facades\Route;

Route::get('/inventarios', function () {
    return Inventario::all();
});

Route::get('/inventarios', [InventarioController::class, 'index']);

