<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// NUEVO
use App\Models\Orden;
use App\Models\OrdenItem;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

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
        // Cargar proveedores (NECESARIO)
        $proveedores = Proveedor::orderBy('nombre')->get();

        // Generar número automático (NECESARIO)
        $ultimo = Orden::latest('id')->first();
        $numero = $ultimo ? $ultimo->id + 1 : 1;
        $numero = str_pad($numero, 6, '0', STR_PAD_LEFT);

        // Enviar datos a la vista
        return view('orden.reponer', compact('proveedores', 'numero'));
    }

public function guardarReponer(Request $request)
{
    $request->validate([
        'fecha' => 'required',
        'proveedor' => 'required',
        'cantidad' => 'required|array',
        'descripcion' => 'required|array',
    ]);

    DB::transaction(function () use ($request) {

        // Generar número
        $ultimo = Orden::latest('id')->first();
        $numero = $ultimo ? $ultimo->id + 1 : 1;
        $numero = str_pad($numero, 6, '0', STR_PAD_LEFT);

        //  Crear orden
        $orden = Orden::create([
            'numero' => $numero,
            'fecha' => $request->fecha,
            'proveedor' => $request->proveedor,
            'lugar' => $request->lugar,
            'solicitado' => $request->solicitado,
            'concepto' => $request->concepto,
            'subtotal' => 0,
            'descuento' => 0,
            'impuesto' => 0,
            'total' => 0,
        ]);

        $subtotal = 0;
        $descuentoTotal = 0;

        // Guardar detalles
        foreach ($request->cantidad as $i => $cant) {

            // ⛔ Saltar filas vacías
            if (empty($cant) || empty($request->descripcion[$i])) {
                continue;
            }

            $precio = $request->precio[$i] ?? 0;
            $desc = $request->descuento[$i] ?? 0;

            $valor = ($cant * $precio) - $desc;

            OrdenDetalle::create([
                'orden_id' => $orden->id,
                'cantidad' => $cant,
                'descripcion' => $request->descripcion[$i],
                'unidad' => $request->unidad[$i] ?? '',
                'precio' => $precio,
                'descuento' => $desc,
                'valor' => $valor,
            ]);

            $subtotal += ($cant * $precio);
            $descuentoTotal += $desc;
        }

        //  Totales
        $impuesto = $subtotal * 0.15;
        $total = $subtotal - $descuentoTotal + $impuesto;

        //  Actualizar orden
        $orden->update([
            'subtotal' => $subtotal,
            'descuento' => $descuentoTotal,
            'impuesto' => $impuesto,
            'total' => $total,
        ]);
    });

    return redirect()
        ->route('orden.reponer')
        ->with('success', '✅ Orden guardada correctamente');
}

    // Mostrar el formulario de crear orden
    public function create()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();

        // Generar número automático
        $ultimo = Orden::latest('id')->first();
        $numero = $ultimo ? $ultimo->id + 1 : 1;
        $numero = str_pad($numero, 6, '0', STR_PAD_LEFT);

        return view('orden.reponer', compact('proveedores', 'numero'));
    }

    // Guardar la orden
    public function store(Request $request)
    {
        $data = $request->validate([
            'numero' => 'required|string',
            'fecha' => 'required|date',
            'proveedor_id' => 'nullable|exists:proveedores,id',
            'lugar' => 'nullable|string',
            'subtotal' => 'nullable|numeric',
            'descuento' => 'nullable|numeric',
            'impuesto' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'items' => 'required|array|min:1',
            'items.*.descripcion' => 'required|string',
            'items.*.unidad' => 'nullable|string',
            'items.*.cantidad' => 'required|numeric|min:1',
            'items.*.precio_unitario' => 'required|numeric|min:0',
            'items.*.descuento' => 'nullable|numeric|min:0',
            'items.*.valor' => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($data) {

            // Crear la orden
            $orden = Orden::create([
                'numero' => $data['numero'],
                'fecha' => $data['fecha'],
                'proveedor_id' => $data['proveedor_id'] ?? null,
                'lugar' => $data['lugar'] ?? null,
                'subtotal' => $data['subtotal'] ?? 0,
                'descuento' => $data['descuento'] ?? 0,
                'impuesto' => $data['impuesto'] ?? 0,
                'total' => $data['total'] ?? 0,
                'estado' => 'pendiente',
            ]);

            // Insertar los items
            foreach ($data['items'] as $item) {
                $valor = $item['valor'] ??
                        (($item['cantidad'] * $item['precio_unitario']) - ($item['descuento'] ?? 0));

                $orden->items()->create([
                    'descripcion' => $item['descripcion'],
                    'unidad' => $item['unidad'] ?? null,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio_unitario'],
                    'descuento' => $item['descuento'] ?? 0,
                    'valor' => $valor,
                ]);
            }
        });

        return redirect()->route('orden.index')->with('success', 'Orden guardada correctamente.');
    }

    // Mostrar lista de órdenes
    public function index()
    {
        $ordenes = Orden::with('proveedor')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('orden.ordenesindex', compact('ordenes'));
    }
}


