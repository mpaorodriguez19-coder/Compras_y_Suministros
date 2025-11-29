<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdenCompraController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\OrdenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta de inicio
Route::get('/', [OrdenCompraController::class, 'index']);

// Rutas del panel
Route::get('/orden/espera', [OrdenController::class, 'enEspera'])->name('orden.espera');
Route::get('/orden/reponer', [OrdenController::class, 'reponer'])->name('orden.reponer');
Route::get('/informe-detallado', [PanelController::class, 'informeDetallado'])->name('informe.detallado');
Route::get('/compras-proveedor', [PanelController::class, 'comprasProveedor'])->name('compras.proveedor');
Route::get('/resumen-proveedor', [PanelController::class, 'resumenProveedor'])->name('resumen.proveedor');
Route::get('/informe', [PanelController::class, 'informe'])->name('informe');
Route::get('/transparencia', [PanelController::class, 'transparencia'])->name('transparencia');

// Rutas de botón reponer
Route::get('/orden/reponer/{id}', [OrdenController::class, 'reponer'])->name('orden.reponer.id');
Route::post('/orden/store', [OrdenController::class, 'store'])->name('orden.store');



