@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
<script type="text/javascript">

  function obtener(){
    var r = document.getElementById('selc_cuenta').value;
    document.getElementById('id_cta').value = r;
  }

</script>
<label ><h3>Depósitos</h3></label>
<div class="row">
  <br>
  <div class="col-md-5">
  <form method="GET"  action="{{route('deposito.index')}}" >
    <div class="input-group input-group-flat">
      <input type="text" class="form-control" name="fecha" id="fecha" placeholder="Busqueda por descripción de depósito">
      <span class="input-group-btn">

        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Buscar</button>

      </span>
    </div>
  </form>
</div>

  <div class="contenedor-modal">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ventana_crear"><span class="glyphicon glyphicon-plus"></span> Agregar Depósito</button>
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
        <h4 class="modal-title" id="myModalLabel">Nuevo depósito</h4>
      </div>
      <div class="modal-body">
        <form method="post"  action="{{route('deposito.create')}}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box-body">
            <label for="monto">Monto</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
              <input class="form-control" type="number" min="0" step="0.01" name="monto"/>
            </div>
            <br>
            <label for="descripcion">Descripción del depósito</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
              <input class="form-control" type="text" name="descripcion" id="descripcion" />
            </div>
            <br>
            <label for="cuenta">Cuenta</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-slack"></i></span>
              <select class="form-control" id="selc_cuenta" onchange="obtener()">
                <option value="0">Seleccione una cuenta</option>
                <?php $ctas = DB::table('cuentas')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->select('cuentas.id','cuentas.numero_cuenta', 'tipo_cuentas.descripcion as descripcion','propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->get(); ?>
                @foreach($ctas as $cta)
                <option value="<?php echo $cta->id; ?>"><?php echo $cta->numero_cuenta. ' / ' .$cta->nombre. ' / ' .$cta->entidad. ' / ' .$cta->descripcion?></option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span> Guardar</button>  
            <input type="hidden" name="id_cuenta" id="id_cta" />
            <input type="hidden" name="id_usuario" value="{{ Auth::user()->id }}" />
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
    <h3 class="box-title" align="text-center">Depósitos</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <table class="table table-hover table-bordered" id="tablatipousuario">
    <thead>
      <tr bgcolor="#98A8D5">
        <th class='text-center'>Usuario</th>
        <th class='text-center'>Monto</th>
        <th class='text-center'>Descripción</th>
        <th class='text-center'>Banco</th>
        <th class='text-center'>Número de cuenta</th>
        <th class='text-center'>Tipo de cuenta</th>
        <th class='text-center'>Fecha y hora del depósito</th>
        <th class='text-center'>Propietario</th>
        <th class='text-center'>Opciones</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      @foreach($depositos as $dp)
      <tr class='text-center'>
        <td><?php echo $dp->nombre_usuario?></td>
        <td><?php echo $dp->monto?></td>
        <td><?php echo $dp->motivo?></td>
        <td><?php echo $dp->entidad?></td>
        <td><?php echo $dp->num_cta?></td>
        <td><?php echo $dp->tp_descripcion?></td>
        <td><?php echo $dp->created_at?></td>
        <td><?php echo $dp->nombre?></td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-3">
             <form action="{{route ('deposito.cambio', $dp->id)}}" method="post">
              {{csrf_field()}}
              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('deposito.delete', $dp->id)}}" method="post">
                {{csrf_field()}}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger btn-xs">Borrar</button>
              </form>
            </form>
          </div>
        </div>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
{{ $depositos->links() }}
@endsection