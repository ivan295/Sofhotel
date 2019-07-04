<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura_Compra extends Model
{
    
    protected $table = 'factura_compra';
  	protected $fillable = ['descripcion','total_pagar','id_proveedor','id_usuario'];
}
