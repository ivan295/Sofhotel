<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura_venta extends Model
{
    public $timestamps = false;
    protected $table = 'factura_venta';
  	protected $fillable = ['total_alquiler','total_productos','total_cobro','id_alquiler'];
}
