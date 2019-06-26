<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
   public $timestamps = false;
    protected $table = 'bancos';
  protected $fillable = ['entidad'];






  public function Scopesearch($query, $entidad){

  		return $query -> where('entidad','LIKE',"%$entidad%");

  	}
}
