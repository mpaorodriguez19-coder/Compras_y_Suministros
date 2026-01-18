<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrdenItem;

class Orden extends Model
{
    use HasFactory;

    // 🔹 Especificar la tabla correcta
    protected $table = 'ordenes';

    // 🔹 Campos que se pueden asignar masivamente
    protected $fillable = [
        'fecha',
        'proveedor_id',       // si esto es proveedor_id, ajusta el nombre
        'lugar',
        'solicitado_por',  // si esto es solicitante_id, ajusta
        'concepto',
        'sub_total',
        'descuento_total',
        'impuesto',
        'total',
        'numero'
    ];

    // 🔹 RELACIÓN CON LOS ITEMS
   public function items()
{
    return $this->hasMany(OrdenCompraDetalle::class, 'orden_compra_id', 'id');
}

    // 🔹 RELACIÓN CON PROVEEDOR
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor', 'id'); // ajusta 'proveedor' si es proveedor_id
    }

    // 🔹 RELACIÓN CON SOLICITANTE
    public function solicitante()
    {
        return $this->belongsTo(User::class, 'solicitado_por', 'id'); // ajusta según tu campo
    }
}
