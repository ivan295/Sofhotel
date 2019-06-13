@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')

<script type="text/javascript">
  function consultar(){
    var dato = document.getElementById('consulta_tipo').value;
    document.getElementById('idtipo').value = dato;
  }
</script>
<!-- box con input para crear habitaciones -->
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Crear Usuario</h3>
      </div>
      <form method="post"  action="{{route('nuevouser.update', $Nuevousuario->id)}}" target="request">
        {{csrf_field()}}
       {{ method_field('PUT') }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <div class="col-md-6">
          <label for="nombre">Nombre</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa  fa-user"></i></span>
            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $Nuevousuario->nombre; ?>" >
          </div>
        </div>
        <div class="col-md-6">
          <label for="apellido">Apellido</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo $Nuevousuario->apellido; ?>" >
          </div>
          </div>
          <div class="col-md-6">
          <label for="cedula">Cédula</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-slack"></i></span>
            <input type="text" class="form-control" name="cedula" id="cedula" value="<?php echo $Nuevousuario->cedula; ?>">
          </div>
          </div>
          <div class="col-md-6">
          <label for="Usuario">Usuario</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
            <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo $Nuevousuario->usuario; ?>">
          </div>
          </div>
          <div class="col-md-6">
          <label for="password">Contraseña</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-key "></i></span>
            <input type="text" class="form-control" name="password" id="password" placeholder="Contraseña" required>
          </div>
          </div>
          <div class="col-md-6">
          <label for="direccion">Dirección</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map"></i></span>
            <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $Nuevousuario->direccion; ?>" required>
          </div>
          </div>
          <div class="col-md-6">
          <label for="telefono">Teléfono</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa fa-phone"></i></span>
            <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $Nuevousuario->telefono; ?>" required>
          </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
            <label>Tipo de Usuario</label>
            <select class="form-control" name="idtipouser" id="consulta_tipo" onchange="consultar()">                    
              <option value="0"></option>
              <?php $tipousuario = DB::table('tipousuario')->get();?>
              @foreach($tipousuario as $tipouser)
              <option value="<?php  echo $tipouser->id ; ?>"> <?php echo $tipouser->descripcion; ?>  </option>
              @endforeach
            </select>
          </div>
          <input type="hidden" id="idtipo" name="idtipouser">
        </div>
      </div>
        <div class="box-footer">
          <button type="submit"class="btn btn-success">Modificar</button>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection