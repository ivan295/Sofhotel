<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'producto';
  	protected $fillable = ['descripcion', 'precio_venta', 'stock', 'precio_compra','id_proveedor','estado'];

  	public function Scopesearch($query, $descripcion){

  		return $query -> where('descripcion','LIKE',"%$descripcion%");

  	}
}
