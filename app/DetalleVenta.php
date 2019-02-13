<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $fillable=[
        'id_producto','fecha','cantidad','id_user','estado',
    ];
}
