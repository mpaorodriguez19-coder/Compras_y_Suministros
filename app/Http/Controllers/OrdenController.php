<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\OrdenItem;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $request->validate([
            'fecha' => 'required|date',
            'proveedor' => 'nullable|string',
            'lugar' => 'nullable|string',
            'solicitado' => 'nullable|string',
            'concepto' => 'nullable|string',

            'items' => 'required|array|min:1',
            'items.*.descripcion' => 'required|string',
            'items.*.unidad' => 'nullable|string',
            'items.*.cantidad' => 'required|numeric|min:1',
            'items.*.precio' => 'required|numeric|min:0',
            'items.*.descuento' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();

    try {

        /* ---------- CREAR ORDEN ---------- */
        $orden = Orden::create([
            'fecha'          => $request->fecha,
            'proveedor'      => $request->proveedor,
            'lugar'          => $request->lugar,
            'solicitado_por' => $request->solicitado,
            'concepto'       => $request->concepto,
            'estado'         => 'pendiente',
        ]);

        /* ---------- GUARDAR ITEMS ---------- */
        foreach ($request->items as $item) {

            if (
                empty($item['descripcion']) ||
                empty($item['cantidad']) ||
                empty($item['precio'])
            ) {
                continue;
            }

            $descuento = $item['descuento'] ?? 0;
            $total = ($item['cantidad'] * $item['precio']) - $descuento;

            OrdenItem::create([
                'orden_id'        => $orden->id,
                'descripcion'     => $item['descripcion'],
                'unidad'          => $item['unidad'] ?? null,
                'cantidad'        => $item['cantidad'],
                'precio_unitario' => $item['precio'],
                'descuento'       => $descuento,
                'valor'           => $total,
            ]);
        }

        DB::commit();

        /* 👉 PASO 4: MOSTRAR PDF AUTOMÁTICAMENTE */
        return redirect()->route('orden.pdf', $orden->id);

    } catch (\Exception $e) {
        DB::rollBack();

        return back()->with('error', 'Error al guardar la orden');
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
