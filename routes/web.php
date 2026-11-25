<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// Página única (SPA por hash). El catálogo inicial se renderiza en el servidor.
Route::get('/', fn () => view('home', ['products' => Product::latest()->get()]));

// Autenticación (con límite de intentos 'auth', ver AppServiceProvider)
Route::middleware('throttle:auth')->group(function () {
    Route::post('/registro', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Productos: lectura pública; escritura solo productor/gestor (+ Policy por dueño)
Route::get('/productos', [ProductController::class, 'index']);
Route::get('/productos/{product}', [ProductController::class, 'show']);
Route::middleware(['auth', 'role:productor,gestor'])->group(function () {
    Route::post('/productos', [ProductController::class, 'store']);
    Route::put('/productos/{product}', [ProductController::class, 'update']);
    Route::delete('/productos/{product}', [ProductController::class, 'destroy']);
});

// Pedidos
Route::middleware('auth')->group(function () {
    Route::get('/pedidos', [OrderController::class, 'index']);
    Route::post('/pedidos', [OrderController::class, 'store'])->middleware('role:comprador');
    Route::patch('/pedidos/{order}/estado', [OrderController::class, 'updateStatus']);
});

// Dashboard del gestor
Route::middleware(['auth', 'role:gestor'])->prefix('panel')->group(function () {
    Route::get('/resumen', [PanelController::class, 'resumen']);
    Route::get('/usuarios', [PanelController::class, 'usuarios']);
});
