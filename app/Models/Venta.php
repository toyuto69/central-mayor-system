<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'producto_id',
        'cantidad_vendida',
        'total',
        'fecha_venta',
    ];

    public function inventario()
    {
        return $this->belongsTo(Inventario::class, 'producto_id');
    }
}