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
        <h3 class="box-title">Reporte mensual</h3>
      </div>
     		<form method="post"  action="{{ route('reporte_deposito.mensual') }}" target="blank">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box-body">
              <label for="fecha">Mes:</label>
              <input type="month" name="mes" id="fecha_inicial" class="form-control" value="<?php echo date("Y-m");?>">
            </div>  
          <div class="box-footer">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>Generar</button>  
          </div>
        </form>

    

  </div>
</div>
</div>
@endsection
