<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdenController extends Controller
{
    // Mostrar las órdenes en espera
    public function enEspera()
    {
        // Aquí puedes traer las órdenes con estado "en espera" desde tu modelo
        // Ejemplo:
        // $ordenes = Orden::where('estado', 'espera')->get();

        return view('orden.espera'); // Vista que mostrará la info
    }

    // Mostrar o gestionar la reposición de una orden
    public function reponer()
    {
        // Ejemplo: lógica para mostrar formulario de reposición
        return view('orden.reponer');
    }
}
