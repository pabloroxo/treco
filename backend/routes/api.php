<?php

use App\Http\Controllers\ComissaoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\VendedorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('vendedores')->group(function () {
    Route::get('/', [VendedorController::class, 'index']);
    Route::get('/{vendedor}', [VendedorController::class, 'show']);
    Route::post('/', [VendedorController::class, 'store']);
    Route::put('/{vendedor}', [VendedorController::class, 'update']);
    Route::delete('/{vendedor}', [VendedorController::class, 'destroy']);
});

Route::prefix('vendas')->group(function () {
    Route::get('/', [VendaController::class, 'index']);
    Route::get('/{venda}', [VendaController::class, 'show']);
    Route::post('/', [VendaController::class, 'store']);
    Route::put('/{venda}', [VendaController::class, 'update']);
    Route::delete('/{venda}', [VendaController::class, 'destroy']);
});

Route::prefix('comissoes/{vendedor}')->group(function () {
    Route::get('/', [ComissaoController::class, 'index']);
    Route::get('/{data_venda}', [ComissaoController::class, 'show']);
});