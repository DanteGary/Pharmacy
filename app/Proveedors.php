<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedors extends Model
{
    protected $fillable=[
        'nombre','nit','direccion','telefono','estado',
    ];
}
