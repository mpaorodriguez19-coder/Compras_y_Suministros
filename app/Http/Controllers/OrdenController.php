<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\OrdenItem;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrdenController extends Controller
{
    
    // Mostrar lista de órdenes 
    public function index(Request $request)
    {
        $query = Orden::with('proveedor')->orderBy('created_at', 'desc');

        // 🔹 FILTRO POR FECHAS (Desde / Hasta)
        if ($request->filled('desde') && $request->filled('hasta')) {
            $query->whereBetween('fecha', [
                Carbon::parse($request->desde)->startOfDay(),
                Carbon::parse($request->hasta)->endOfDay(),
            ]);
        }

        // 🔹 Paginación con preservación de parámetros en la URL
        $ordenes = $query->paginate(10)->appends($request->all());

        return view('orden.ordenesindex', compact('ordenes'));
    }

 
    // Mostrar formulario para crear una nueva orden
  
    public function create()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();

        // Generar número automático de orden
        $ultimo = Orden::latest('id')->first();
        $numero = $ultimo ? $ultimo->id + 1 : 1;
        $numero = str_pad($numero, 6, '0', STR_PAD_LEFT);

        return view('orden.reponer', compact('proveedores', 'numero'));
    }

 
    // Guardar una nueva orden y sus items

    public function store(Request $request)
    {
        // Validación de datos
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

            // Guardar los items de la orden
            foreach ($data['items'] as $item) {
                $valor = $item['valor'] ?? (($item['cantidad'] * $item['precio_unitario']) - ($item['descuento'] ?? 0));

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

   
    // Mostrar formulario de reposición 
  
    public function reponer()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();

        $ultimo = Orden::latest('id')->first();
        $numero = $ultimo ? $ultimo->id + 1 : 1;
        $numero = str_pad($numero, 6, '0', STR_PAD_LEFT);

        return view('orden.reponer', compact('proveedores', 'numero'));
    }


    // Guardar datos temporales de reposición 

    public function guardarReponer(Request $request)
    {
        $orden = Orden::create([
            'fecha' => $request->fecha,
            'proveedor' => $request->proveedor,
            'lugar' => $request->lugar,
            'solicitado_por' => $request->solicitado,
            'concepto' => $request->concepto,
            'items' => json_encode($request->descripcion),
        ]);

        $proveedores = Proveedor::orderBy('nombre')->get();
        $numero = str_pad($orden->id, 6, '0', STR_PAD_LEFT);

        return view('orden.reponer', [
            'proveedores' => $proveedores,
            'numero' => $numero,
            'oldInput' => $request->all()
        ])->with('success', 'Orden guardada correctamente');
    }

   
    // Mostrar órdenes en estado "en espera"
  
    public function enEspera()
    {
        // Ejemplo: $ordenes = Orden::where('estado', 'espera')->get();
        return view('orden.espera');
    }
}
