@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
<script type="text/javascript">

    function obtener_tipo(){
        var r = document.getElementById('tipo_cta').value;
        document.getElementById('id_tip').value = r;
    }

    function obtener_propietario(){
        var r = document.getElementById('prop').value;
        document.getElementById('id_prop').value = r;
    }

    function obtener_banco(){
        var r = document.getElementById('banc').value;
        document.getElementById('id_banc').value = r;
    }

</script>
@include('adminlte::alerts.error')
  @include('adminlte::alerts.exito')
<label ><h3>Cuentas</h3></label>
<div class="row">
  <br>
  <div class="col-md-5">
  <form method="GET"  action="{{route('cuenta.index')}}" >
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="input-group input-group-flat">
      <input type="text" class="form-control" name="numero" id="numero" placeholder="Busqueda por número de cuenta">
      <span class="input-group-btn">

        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Buscar</button>

      </span>
    </div>
  </form>
</div>

  <div class="contenedor-modal">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ventana_crear"><span class="glyphicon glyphicon-plus"></span> Agregar Cuenta</button>
  </div>
</div>
<br>
<!--ventana modal-->
<div class="modal fade" id="ventana_crear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Nueva cuenta</h4>
      </div>
      <div class="modal-body">
       @include('adminlte::alerts.error')
      <form method="post"  action="{{route('cuenta.create')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <label for="numero_cuenta">Número de cuenta</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-slack"></i></span>
            <input type="text" class="form-control" name="numero_cuenta"  id="numero_cuenta" placeholder="Numero de cuenta" required>
          </div>
          <br>
          <label for="numero_cuenta">Tipo de cuenta</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-database"></i></span>
            <select class="form-control"  id="tipo_cta" onchange="obtener_tipo()">
              <option value="0">Seleccione un tipo de cuenta</option>
                    <?php $tipo_cta = DB::table('tipo_cuentas')->get(); ?>
                    @foreach($tipo_cta as $tc)
                    <option value=" <?php echo $tc->id ?>" > <?php echo $tc->descripcion; ?> </option>
                    @endforeach
            </select>
          </div>
          <br>
          <label for="numero_cuenta">Propietario de cuenta</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <select class="form-control" id="prop" onchange="obtener_propietario()">
                    <option value="0">Seleccione un propietario</option>
                    <?php $propietario_cuentas = DB::table('propietario_cuentas')->get(); ?>
                    @foreach($propietario_cuentas as $pc)
                    <option value="<?php echo $pc->id ?>"> <?php echo $pc->nombre; ?> </option>
                    @endforeach
                 </select>
          </div>
          <br>
          <label for="numero_cuenta">Banco</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-bank"></i></span>
            <select class="form-control" id="banc" onchange="obtener_banco()">
                    <option value="0">Seleccione un banco</option>
                    <?php $banco = DB::table('bancos')->get(); ?>
                    @foreach($banco as $b)
                    <option value=" <?php echo $b->id ?>"> <?php echo $b->entidad; ?></option>
                    @endforeach
                 </select>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span> Guardar</button>  
          <input type="hidden" id="id_tip" name="id_tipo_cuenta">
            <input type="hidden" id="id_prop" name="id_propietario">
            <input type="hidden" id="id_banc" name="id_banco">
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- box con input para crear tipo de usuario -->

<div class="col-md-14">
  <div class="box box-primary">
   <div class="box-header with-border">
    <i class="fa fa-bar-chart"></i>
    <h3 class="box-title" align="text-center">Cuentas</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <table class="table table-hover table-bordered" id="tablatipousuario">
    <thead>
      <tr bgcolor="#98A8D5">
        <th class='text-center'>#</th>
        <th class='text-center'>Propietario o Entidad</th>
        <th class="text-center">Banco</th>
         <th class="text-center">Número de cuenta</th>
         <th class="text-center">Tipo de cuenta</th>
         <th class="text-center">Opciones</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      @foreach($cuentas as $cta)
      <tr class='text-center'>
       <td><?php echo $cta->id?></td> 
        <td><?php echo $cta->nombre?></td>
        <td><?php echo $cta->entidad?></td>
        <td><?php echo $cta->numero_cuenta?></td>
         <td><?php echo $cta->descripcion?></td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-3">
             <form action="{{route ('cuenta.cambio', $cta->id)}}" method="post">
              {{csrf_field()}}
              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('cuenta.delete', $cta->id)}}" method="post">
                {{csrf_field()}}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger btn-xs" onclick="return borrar()">Borrar</button>
              </form>
            </form>
          </div>
        </div>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
{{ $cuentas->links() }}
<script src="{{ asset('/js/alerta_confirmacion.js') }}" defer></script>

@endsection