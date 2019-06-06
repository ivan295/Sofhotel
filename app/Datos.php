<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datos extends Model
{
    public $timestamps = false;
    protected $table = 'datos';
  protected $fillable = ['temperatura', 'humedad'];
}
