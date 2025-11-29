<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenItem extends Model
{
    protected $table = 'orden_items'; // Nombre real de tu tabla

    protected $fillable = [
        'orden_id',
        'descripcion',
        'unidad',
        'cantidad',
        'precio_unitario',
        'descuento',
        'valor'
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class, 'orden_id');
    }
}


