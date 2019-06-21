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

<label ><h3>Usuarios</h3></label>
<div class="row">
<br>
<div class="col-md-5">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-search"></i></span>
 <input type="text" class="form-control" name="buscar_producto" id="buscar_producto" placeholder="Busqueda por nombre">
</div>
</div>
<div class="col-md-5">
  <input type="hidden" name="hidden">
</div>
<div class="contenedor-modal">
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ventana_crear"><span class="glyphicon glyphicon-plus"></span> Nuevo usuario</button>
</div>
</div>
<br>
<!--ventana modal -->
<div class="modal fade" id="ventana_crear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Crear nuevo usuario</h4>
      </div>
      <div class="modal-body">
      <form method="post"  action="{{route('nuevouser.create')}}" target="request">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <div class="col-md-6">
          <label for="nombre">Nombre</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa  fa-user"></i></span>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" >
          </div>
        </div>
        <div class="col-md-6">
          <label for="apellido">Apellido</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" >
          </div>
          </div>
          <div class="col-md-6">
          <label for="cedula">Cédula</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-slack"></i></span>
            <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cédula" >
          </div>
          </div>
          <div class="col-md-6">
          <label for="Usuario">Usuario</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" >
          </div>
          </div>
          <div class="col-md-6">
          <label for="password">Contraseña</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-key "></i></span>
            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
          </div>
          </div>
          <div class="col-md-6">
          <label for="direccion">Dirección</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map"></i></span>
            <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" required>
          </div>
          </div>
          <div class="col-md-6">
          <label for="telefono">Teléfono</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa fa-phone"></i></span>
            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" required>
          </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
            <label>Tipo de Usuario</label>
            <select class="form-control" name="idtipouser" id="consulta_tipo" onchange="consultar()">                    
              <option value="0">Seleccionar tipo de Usuario</option>
              <?php $tipousuario = DB::table('tipousuario')->get(); ?>
              @foreach($tipousuario as $tipouser)
              <option value="<?php  echo $tipouser->id ; ?>"> <?php echo $tipouser->descripcion; ?>  </option>
              @endforeach
            </select>
          </div>
          <input type="hidden" id="idtipo" name="idtipouser">
        </div>
      </div>
          <button type="submit"class="btn btn-success">Crear</button>
       
      </form> 

    
  </div>
</div>
</div>
</div>
<!-- box para mostrar usuarios -->
<div class="col-md-14">
  <div class="box box-primary">
   <div class="box-header with-border">
    <i class="fa fa-picture-o"></i>
    <h3 class="box-title" align="text-center">Usuarios</h3>
    <div class="box-tools pull-right">
    </div>
  </div> 
  <!--tabla-->
  <table class="table table-hover table-bordered" id="tablausuarios">
    <thead>
      <tr bgcolor="#98A8D5">
        <th class='text-center'>ID</th>
        <th class='text-center'>Nombre</th>
        <th class='text-center'>Apellido</th>
        <th class="text-center">Cédula</th>
        <th class="text-center">Usuario</th>
        <th class="text-center">Dirección</th>
        <th class="text-center">Teléfono</th>
        <th class="text-center">Tipo de usuario</th>
        <th class='text-center'>Opciones</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      @foreach($Nuevousuario as $Nuevouser)
      <tr class='text-center'>
        <td>{{$Nuevouser->id}}</td>
        <td>{{$Nuevouser->nombre}}</td>
        <td>{{$Nuevouser->apellido}}</td>
        <td>{{$Nuevouser->cedula}}</td>
        <td>{{$Nuevouser->usuario}}</td>
        <td>{{$Nuevouser->direccion}}</td>
        <td>{{$Nuevouser->telefono}}</td>
        <td>{{$Nuevouser->TipoUser}}</td>
        <td class="text-center">
          <div class="row">
          </div>
        </div>
        <div class="row">
              <div class="col-md-3 col-md-offset-2">
               <form action="{{route ('nuevouser.editar', $Nuevouser->id)}}" method="post">
                {{csrf_field()}}
                
                <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>

              </div>
              <div class="col-md-3">
               <form action="{{route('nuevouser.delete', $Nuevouser->id)}}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger btn-xs">Borrar</button>
              </form>
            </div>
          </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$Nuevousuario->links()}}
</div>
</div>

@endsection
