<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    protected $fillable=[
        'nombre','marca','cantidad','descripcion','preciounitario','preciocompra','fechavence','id_cat','id_proveedor','id_estante','fechaReg','estado','stockTotal',
        // ,'id_cap','capacidad',
    ];
}
