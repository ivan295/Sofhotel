<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_venta';
    protected $fillable = ['cantidad','total_venta','id_factura_venta','id_producto'];


}
