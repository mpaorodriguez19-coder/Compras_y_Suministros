<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdenCompraController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\OrdenController;




/* HOME */
Route::get('/', [OrdenCompraController::class, 'index'])
    ->name('home');

/* ÓRDENES */

/* Órdenes en espera */
Route::get('/orden/espera', [OrdenController::class, 'enEspera'])
    ->name('orden.espera');

/* Formulario Reponer */
Route::get('/orden/reponer', [OrdenController::class, 'reponer'])
    ->name('orden.reponer');

/* Guardar Reponer + REDIRECCIONA AL PDF */
Route::post('/orden/reponer/guardar', [OrdenController::class, 'store'])
    ->name('orden.reponer.guardar');

/* VER PDF DE LA ORDEN (AUTOMÁTICO) */
Route::get('/orden/{id}/pdf', [OrdenController::class, 'pdf'])
    ->name('orden.pdf');

/* INFORMES / PANEL */

Route::get('/informe-detallado', [PanelController::class, 'informeDetallado'])
    ->name('informe.detallado');

Route::get('/compras-proveedor', [PanelController::class, 'comprasProveedor'])
    ->name('compras.proveedor');

Route::get('/resumen-proveedor', [PanelController::class, 'resumenProveedor'])
    ->name('resumen.proveedor');

Route::get('/informe', [PanelController::class, 'informe'])
    ->name('informe');

Route::get('/transparencia', [PanelController::class, 'transparencia'])
    ->name('transparencia');
