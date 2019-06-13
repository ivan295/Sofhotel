<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    public $timestamps = false;
    protected $table = 'producto';
  	protected $fillable = ['descripcion', 'precio_venta', 'stock', 'precio_compra','id_proveedor'];
}
