<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finanza extends Model
{
    protected $fillable = [
        'tipo',
        'monto',
        'fecha',
        'descripcion',
    ];
}