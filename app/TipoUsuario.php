<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    public $timestamps = false;
    protected $table = 'tipousuario';
  protected $fillable = ['descripcion'];

   public function Scopesearch($query, $descripcion){

  		return $query -> where('descripcion','LIKE',"%$descripcion%");

  	}

  
}
