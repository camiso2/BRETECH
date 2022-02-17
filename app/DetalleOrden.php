<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    protected $table = "detalle_ordens";
    protected $fillable = [
        "numeroFactura",
        "cliente",
        "telefono",
        "email",
        "detallesOrden",
        "granSubtotal",
        "granIva",
        "granTotal",
        "user_id",
    ];
}

