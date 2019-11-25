@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Parámetros</h3>
            </div>
            <form method="post" action="{{route('iva.update', $iva->id)}}">
                {{csrf_field()}}
                {{ method_field('PUT') }}
                <div class="box-body">
                <label for="tipousuario">IVA</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <input type="number" class="form-control" name="iva" id="iva" value="<?php echo $iva->valor; ?>">
                </div>
          <br>
          <div class="box-footer">
          <button type="submit"class="btn btn-success">Modificar</button>
          <button type="submit" class="btn btn-danger" onclick="vendor/adminlte/gastos.php">Salir</button>
        </div>
      </form>
                
    </div>
</div>

@endsection