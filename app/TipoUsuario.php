<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    public $timestamps = false;
    protected $table = 'tipousuario';
  protected $fillable = ['descripcion'];
}
