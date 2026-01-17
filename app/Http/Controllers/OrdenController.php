<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\OrdenItem;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class OrdenController extends Controller
{
    /* LISTADO DE ÓRDENES + FILTRO POR FECHAS */
    public function index(Request $request)
    {
        $query = Orden::orderBy('created_at', 'desc');

        if ($request->filled('desde') && $request->filled('hasta')) {
            $query->whereBetween('fecha', [
                Carbon::parse($request->desde)->startOfDay(),
                Carbon::parse($request->hasta)->endOfDay(),
            ]);
        }

        $ordenes = $query->paginate(10)->appends($request->all());

        return view('orden.ordenesindex', compact('ordenes'));
    }

    /* FORMULARIO NUEVA ORDEN (REPONER) */
    public function create()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();

        $ultimo = Orden::latest('id')->first();
        $numero = $ultimo ? $ultimo->id + 1 : 1;
        $numero = str_pad($numero, 6, '0', STR_PAD_LEFT);

        return view('orden.reponer', compact('proveedores', 'numero'));
    }

    /*  GUARDAR ORDEN + ITEMS (TABLA DINÁMICA) */
    public function store(Request $request)
    {
        Log::info('OrdenController@store called', ['ip' => $request->ip(), 'payload_keys' => array_keys($request->all())]);

        // Validate based on the form inputs (arrays with [] names)
        $request->validate([
            'fecha' => 'required|date',
            'proveedor' => 'nullable|string',
            'lugar' => 'nullable|string',
            'solicitado' => 'nullable|string',
            'concepto' => 'nullable|string',

            // Arrays must be present, but individual elements can be empty because the JS pre-populates rows
            'descripcion' => 'required|array|min:1',
            'cantidad' => 'required|array|min:1',
            'precio_unitario' => 'required|array|min:1',
            'descuento' => 'nullable|array',
            'unidad' => 'nullable|array',
        ]);

        DB::beginTransaction();

        try {
            Log::info('OrdenController@store validation passed');

            // Compute a sequential numero (6 digits) like in create()
            $ultimo = Orden::latest('id')->first();
            $numero = $ultimo ? $ultimo->id + 1 : 1;
            $numero = str_pad($numero, 6, '0', STR_PAD_LEFT);

            // Map proveedor/solicitado to *_id if numeric (form provides free text so allow null)
            $proveedor_id = null;
            if ($request->filled('proveedor') && is_numeric($request->proveedor)) {
                $proveedor_id = (int) $request->proveedor;
            }

            $solicitante_id = null;
            if ($request->filled('solicitado') && is_numeric($request->solicitado)) {
                $solicitante_id = (int) $request->solicitado;
            }

            // Calculate totals from submitted rows
            $subtotal = 0;
            $descuentoTotal = 0;
            $impuesto = 0; // keep 0 for now or compute if you have tax rules

            $rows = max(count($request->descripcion ?? []), count($request->cantidad ?? []), count($request->precio_unitario ?? []));

            // Filter and prepare valid item rows
            $validItems = [];
            for ($i = 0; $i < $rows; $i++) {
                $descripcion = trim($request->descripcion[$i] ?? '');
                $cantidad = isset($request->cantidad[$i]) ? (float) $request->cantidad[$i] : 0;
                $unidad = $request->unidad[$i] ?? null;
                $precio = isset($request->precio_unitario[$i]) ? (float) $request->precio_unitario[$i] : 0;
                $descuento = isset($request->descuento[$i]) ? (float) $request->descuento[$i] : 0;

                // Only accept rows with a description and a positive quantity and a price >= 0
                if ($descripcion !== '' && $cantidad > 0 && $precio >= 0) {
                    $validItems[] = [
                        'descripcion' => $descripcion,
                        'cantidad' => $cantidad,
                        'unidad' => $unidad,
                        'precio' => $precio,
                        'descuento' => $descuento,
                    ];
                }
            }

            if (count($validItems) === 0) {
                // No valid lines to save
                return back()->withInput()->with('error', 'Debe ingresar al menos una línea con descripción, cantidad y precio.');
            }

            // Create the orden
            $orden = Orden::create([
                'numero' => $numero,
                'fecha' => $request->fecha,
                'proveedor_id' => $proveedor_id,
                'lugar' => $request->lugar,
                'solicitante_id' => $solicitante_id,
                'subtotal' => 0, // temporary, will update after items
                'descuento' => 0,
                'impuesto' => $impuesto,
                'total' => 0,
                'estado' => 'pendiente',
            ]);

            // Save items and compute totals
            foreach ($validItems as $item) {
                $valor = ($item['cantidad'] * $item['precio']) - $item['descuento'];

                OrdenItem::create([
                    'orden_id' => $orden->id,
                    'descripcion' => $item['descripcion'],
                    'unidad' => $item['unidad'],
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                    'descuento' => $item['descuento'],
                    'valor' => $valor,
                ]);

                $subtotal += ($item['cantidad'] * $item['precio']);
                $descuentoTotal += $item['descuento'];
            }

            $total = $subtotal - $descuentoTotal + $impuesto;

            // Update orden totals
            $orden->update([
                'subtotal' => $subtotal,
                'descuento' => $descuentoTotal,
                'impuesto' => $impuesto,
                'total' => $total,
            ]);

            DB::commit();

            Log::info('OrdenController@store committed', ['orden_id' => $orden->id]);

            // Redirect to PDF view
            return redirect()->route('orden.pdf', $orden->id);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('OrdenController@store Exception: ' . $e->getMessage(), ['exception' => $e]);

            // Return with the actual error message to help debug (remove in production)
            return back()->with('error', 'Error al guardar la orden: ' . $e->getMessage());
        }
    }

    /* MOSTRAR FORMULARIO REPONER  */
    public function reponer()
    {
        return $this->create();
    }

    /*  ÓRDENES EN ESPERA*/
    public function enEspera()
    {
        $ordenes = Orden::where('estado', 'pendiente')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('orden.espera', compact('ordenes'));
    }

    public function pdf($id)
{
    $orden = Orden::with('items')->findOrFail($id);

    $pdf = Pdf::loadView('orden.pdf', compact('orden'))
        ->setPaper('letter', 'portrait');

    return $pdf->stream('orden_'.$orden->id.'.pdf');
}

}
