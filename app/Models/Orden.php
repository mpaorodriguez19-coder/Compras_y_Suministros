<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    // Nombre real de la tabla en base de datos
    protected $table = 'ordenes';

    protected $fillable = [
        'numero','fecha','proveedor_id','lugar','solicitante_id',
        'subtotal','descuento','impuesto','total','estado'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function solicitante()
    {
        return $this->belongsTo(\App\Models\User::class, 'solicitante_id');
    }

    public function items()
    {
        return $this->hasMany(OrdenItem::class, 'orden_id');
    }
}
