<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    public $timestamps = false;
    protected $table = 'detalle_compra';
  	protected $fillable = ['cantidad','total_compra','id_factura','id_producto'];

    public function producto(){
        return $this->hasOne('App\Productos','id','id_producto');
    }
    public function factura_compra(){
        return $this->hasOne('App\Factura_Compra','id','id_factura');
    }

}
