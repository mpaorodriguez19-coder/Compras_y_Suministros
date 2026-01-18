<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\OrdenCompraDetalle;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class OrdenController extends Controller
{
    // LISTADO DE ÓRDENES CON FILTRO
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

    // FORMULARIO REPONER NUEVA ORDEN
    public function reponer()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();

        $ultimo = Orden::latest('id')->first();
        $numero = $ultimo ? $ultimo->id + 1 : 1;
        $numero = str_pad($numero, 6, '0', STR_PAD_LEFT);

        return view('orden.reponer', compact('proveedores', 'numero'));
    }

    // GUARDAR ORDEN + DETALLES
    public function store(Request $request)
    {
        Log::info('OrdenController@store', ['payload' => $request->all()]);

        $request->validate([
            'fecha' => 'required|date',
            'descripcion' => 'required|array|min:1',
            'cantidad' => 'required|array|min:1',
            'precio_unitario' => 'required|array|min:1',
            'unidad' => 'nullable|array',
            'descuento' => 'nullable|array',
        ]);

        DB::beginTransaction();

        try {
            $ultimo = Orden::latest('id')->first();
            $numero = $ultimo ? $ultimo->id + 1 : 1;
            $numero = str_pad($numero, 6, '0', STR_PAD_LEFT);

            // Crear ORDEN
            $orden = Orden::create([
                'numero'         => $numero,
                'fecha'          => $request->fecha,
                'proveedor_id'   => $request->proveedor,      // Asegúrate que es ID
                'lugar'          => $request->lugar,
                'solicitante_id' => $request->solicitado,     // Asegúrate que es ID
                'concepto'       => $request->concepto,
                'subtotal'       => 0,
                'descuento'      => 0,
                'impuesto'       => 0,
                'total'          => 0,
                'estado'         => 'pendiente',
            ]);

            $subtotal = 0;
            $descuentoTotal = 0;

            for ($i = 0; $i < count($request->descripcion); $i++) {
                $descripcion = trim($request->descripcion[$i] ?? '');
                $cantidad    = (float) ($request->cantidad[$i] ?? 0);
                $precio      = (float) ($request->precio_unitario[$i] ?? 0);
                $descuento   = (float) ($request->descuento[$i] ?? 0);
                $unidad      = $request->unidad[$i] ?? null;

                if ($descripcion === '' || $cantidad <= 0) continue;

                $valor = ($cantidad * $precio) - $descuento;

                OrdenCompraDetalle::create([
                    'orden_compra_id' => $orden->id,
                    'descripcion'     => $descripcion,
                    'unidad'          => $unidad,
                    'cantidad'        => $cantidad,
                    'precio_unitario' => $precio,
                    'descuento'       => $descuento,
                    'valor'           => $valor,
                ]);

                $subtotal += ($cantidad * $precio);
                $descuentoTotal += $descuento;
            }

            if ($subtotal <= 0) {
                throw new \Exception('Debe ingresar al menos un item válido.');
            }

            $impuesto = 0;
            $total = $subtotal - $descuentoTotal + $impuesto;

            $orden->update([
                'subtotal'  => $subtotal,
                'descuento' => $descuentoTotal,
                'impuesto'  => $impuesto,
                'total'     => $total,
            ]);

            DB::commit();

            // REDIRIGIR CON EL ID CORRECTO
            return redirect()->route('orden.espera', ['id' => $orden->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar orden', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    // MOSTRAR ORDEN RECIÉN GUARDADA (REP2)
    public function verEspera($id)
    {
        $orden = Orden::with(['items', 'proveedor', 'solicitante'])
                      ->findOrFail($id);

        return view('orden.rep2', compact('orden'));
    }

    // GENERAR PDF
    public function pdf($id)
    {
        $orden = Orden::with(['items', 'proveedor', 'solicitante'])
                      ->findOrFail($id);

        $pdf = Pdf::loadView('orden.espera_pdf', compact('orden'))
                  ->setPaper('letter', 'portrait');

        return $pdf->stream('orden_'.$orden->numero.'.pdf');
    }
}
