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
        <h3 class="box-title">Apertura de caja</h3>
      </div>
      <form method="post"  action="crear" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <label for="numero_caja">Numero de caja</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-slack"></i></span>
            <input type="text" class="form-control" name="numero_caja" id="descripcion" readonly="readonly" value="1">
          </div>
          <br>
          <label for="usuario">Usuario</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-slack"></i></span>
            <input type="text" class="form-control" name="usuario" id="descripcion" readonly="readonly" value="{{Auth::user()->usuario}}">
          </div>
          <br>
          <label for="fecha">Fecha y hora de apertura</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
          <input class="form-control" readonly="readonly"  id="fecha" type="datetime" value="<?php date_default_timezone_set("America/Guayaquil"); echo date("Y-m-d H:i:s"); ?>" />
          </div>
          <br>
          <label for="dinero">Dinero en caja</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
          <input class="form-control" readonly="readonly" id="dinero" type="text" name="dinero_caja" value=" <?php echo $dinero->dinero_disponible;?>" />
          </div>
          <br>

      <div class="input-group">
          </div>
          <div class="input-group">
          <!-- <input type="hidden" name="id_dinero" value=" <?php //echo $dinero->id; ?>" /> -->
          <input type="hidden" name="id_usuario" value="{{Auth::user()->id}}">
        </div class="input-group">
      <div class="box-footer">
        <?php $est = DB::table('cajas')->orderBy('id', 'desc')->first();?>
        @if($dinero->dinero_disponible < 1)
        <button type="submit"class="btn btn-success" disabled="true">Abrir caja</button>

        @elseif($est == null)
        <button type="submit"class="btn btn-success">Abrir caja</button>
        @elseif($est->estado == 0)
        <button type="submit"class="btn btn-success">Abrir caja</button>
        @elseif($est->estado == 1)
        <button type="submit"class="btn btn-success" disabled="true">Abrir caja</button>
        @endif
      </div>

    </form>

  </div>
</div>
</div>
@endsection
