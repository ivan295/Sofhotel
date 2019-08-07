@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<!-- box con input para registrar gasto -->
<div class="row">
  <div class="col-md-5 col-md-offset-3" >
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Editar Gastos</h3>
      </div>
      <form method="post"  action=" {{route('gastos.update', $gasto->id)}}" >
      {{csrf_field()}}
      {{ method_field('PUT') }}
        <div class="box-body">
          <label for="numerohabitacion">Descripción</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $gasto->descripcion; ?>">
          </div>
          <br>
          <label for="tipohabitacion">Total a Pagar</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <input type="text" class="form-control" name="gasto_total" id="gasto_total" value="<?php echo $gasto->gasto_total; ?>">
          </div>
          <br>
          <div class="box-footer">
          <button type="submit"class="btn btn-success">Modificar</button>
          <button type="submit" class="btn btn-danger" onclick="vendor/adminlte/parametros.php">Salir</button>
        </div>
      </form>
      
    </div>
  </div>
  </div>
@endsection
