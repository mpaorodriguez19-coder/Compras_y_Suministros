<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenCompraDetalle extends Model
{
    protected $table = 'orden_compra_detalles';

    protected $fillable = [
        'orden_compra_id',
        'cantidad',
        'descripcion',
        'unidad',
        'precio_unitario',
        'descuento',
        'valor',
        'cupon',
         'prueba'
    ];

    /* Los detalles de la compra pertenecen a una orden */
    public function orden()
    {
        return $this->belongsTo(OrdenCompra::class, 'orden_compra_id');
    }

    /* Los detalles pueden ser usandos en multiples elementos de la reposición */
    public function reposiciones()
    {
        return $this->hasMany(ReposicionDetalle::class, 'orden_compra_detalle_id');
    }
}
