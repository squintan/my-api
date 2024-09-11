<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;


Route::get('/inventarios', [InventarioController::class, 'index']); // Listar todos
Route::get('/inventarios/{id}', [InventarioController::class, 'show']); // Mostrar uno
Route::post('/inventarios', [InventarioController::class, 'store']); // Crear
Route::put('/inventarios/{id}', [InventarioController::class, 'update']); // Actualizar
Route::delete('/inventarios/{id}', [InventarioController::class, 'destroy']); // Eliminar
