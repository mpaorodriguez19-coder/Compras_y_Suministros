<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{
     public function informeDetallado() {
        return view('panel.informe-detallado');
    }

    public function comprasProveedor() {
        return view('panel.compras-proveedor');
    }

    public function resumenProveedor() {
        return view('panel.resumen-proveedor');
    }

    public function informe() {
        return view('panel.informe');
    }

    public function transparencia() {
        return view('panel.transparencia');
    }
}
