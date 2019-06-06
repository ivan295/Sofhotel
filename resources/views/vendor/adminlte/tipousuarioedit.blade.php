@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<!-- box con input para editar tipo de usuario -->
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Editar Tipo de Usuario</h3>
      </div>
      <form method="post"  action="{{route('tipouser.update', $tipo_usuario->id)}}" target="request">
       {{csrf_field()}}
       {{ method_field('PUT') }}
        <div class="box-body">
          <label for="tipousuario">Tipo de Usuario</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $tipo_usuario->descripcion; ?>">
          </div>
          <br>
        </div>
        <div class="box-footer">
          <button type="submit"class="btn btn-success">Modificar</button>
          <button type="submit" class="btn btn-danger" onclick="vendor/adminlte/tipousuario.php">Salir</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
