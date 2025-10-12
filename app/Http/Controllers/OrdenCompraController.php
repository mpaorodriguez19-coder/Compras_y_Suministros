<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenCompra;

class OrdenCompraController extends Controller
{
    public function index()
    {
        return view('ordenesindex');
    }

    public function store(Request $request)
    {
        $orden = OrdenCompra::create($request->all());
        return redirect()->back()->with('success', 'Orden registrada correctamente');
    }
}
