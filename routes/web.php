<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\FinanzaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ResumenController;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas de autenticación
require __DIR__.'/auth.php';

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/resumen', [ResumenController::class, 'index'])->name('resumen');

    Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario');
    Route::post('/inventario', [InventarioController::class, 'store']);

    Route::get('/finanzas', [FinanzaController::class, 'index'])->name('finanzas');
    Route::post('/finanzas', [FinanzaController::class, 'store']);

    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas');
    Route::post('/ventas', [VentaController::class, 'store']);

    Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
});