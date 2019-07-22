<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
<<<<<<< HEAD

=======
    //public $timestamps = false;
>>>>>>> ee48a39e92aa350cada851c29c0924e1daa6eac7
    protected $table = 'depositos';
  protected $fillable = ['motivo','monto','id_usuario','id_cuenta', 'created_at', 'update_at'];


  public function Scopesearch($query, $motivo){

  		return $query -> where('motivo','LIKE',"%$motivo%");

  	}
}
