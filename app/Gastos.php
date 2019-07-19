<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    
    protected $table = 'gastos';
  protected $fillable = ['descripcion', 'gasto_total','id_usuario','created_at'];


   public function Scopesearch($query, $descripcion){

  		return $query -> where('descripcion','LIKE',"%$descripcion%");

  	}

}
