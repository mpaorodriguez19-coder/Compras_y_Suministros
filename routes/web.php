<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdenCompraController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\OrdenController;

Route::get('/', [OrdenCompraController::class, 'index']);

// Panel
Route::get('/orden/espera', [OrdenController::class, 'enEspera'])
    ->name('orden.espera');

// Reponer
Route::get('/orden/reponer', [OrdenController::class, 'reponer'])
    ->name('orden.reponer');

Route::post('/orden/reponer/guardar', [OrdenController::class, 'guardarReponer'])
    ->name('orden.reponer.guardar');

// Informes
Route::get('/informe-detallado', [PanelController::class, 'informeDetallado'])->name('informe.detallado');
Route::get('/compras-proveedor', [PanelController::class, 'comprasProveedor'])->name('compras.proveedor');
Route::get('/resumen-proveedor', [PanelController::class, 'resumenProveedor'])->name('resumen.proveedor');
Route::get('/informe', [PanelController::class, 'informe'])->name('informe');
Route::get('/transparencia', [PanelController::class, 'transparencia'])->name('transparencia');