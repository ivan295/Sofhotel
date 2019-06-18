<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    public $timestamps = false;
    protected $table = 'detalle_compra';
  	protected $fillable = ['cantidad','total_compra','id_factura','id_producto'];


}
