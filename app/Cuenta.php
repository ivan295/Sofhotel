<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{

    protected $table = 'cuentas';
  protected $fillable = ['numero_cuenta','id_tipo_cuenta','id_propietario','id_banco'];






  public function Scopesearch($query, $numero_cuenta){

  		return $query -> where('numero_cuenta','LIKE',"%$numero_cuenta%");

  	}
}
