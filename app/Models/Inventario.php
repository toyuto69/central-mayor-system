<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventarios';

    protected $fillable = [
        'producto_nombre',
        'cantidad',
        'precio',
        'fecha_actualizacion',
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'producto_id');
    }
}