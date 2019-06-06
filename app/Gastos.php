<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    public $timestamps = false;
    protected $table = 'gastos';
  protected $fillable = ['descripcion', 'gasto_total', 'hora_gasto', 'fecha_gasto','id_usuario'];
}
