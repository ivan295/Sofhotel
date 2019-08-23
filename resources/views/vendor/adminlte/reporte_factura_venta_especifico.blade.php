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
        <h3 class="box-title">Reporte específico</h3>
      </div>
     		<form method="post"  action="{{route('reporte_factura_venta.especifico')}}" target="blank">
          <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
          {{csrf_field()}}
          <div class="box-body">
              <label for="fecha">Desde:</label>
              <input type="date" name="fecha_inicial" id="fecha_inicial" class="form-control" value="<?php echo date("Y-m-d");?>">
              <label for="fecha">Hasta:</label>
              <input type="date" name="fecha_final" id="fecha_final" class="form-control" value="<?php echo date("Y-m-d");?>">
            </div>  
          <div class="box-footer">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>Generar</button>  
          </div>
        </form>

    

  </div>
</div>
</div>
@endsection