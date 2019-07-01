@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
@if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
<label ><h3>Bancos</h3></label>
<div class="row">
  <br>
  <div class="col-md-4">
  <form method="GET"  action="{{route('banco.index')}}" >
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="input-group input-group-flat">
      <input type="text" class="form-control" name="banco" id="banco" placeholder="Busqueda por nombre">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Buscar</button>
      </span>
    </div>
  </form>
</div>
 <div class="contenedor-modal">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ventana_crear"><span class="glyphicon glyphicon-plus"></span> Nuevo Banco</button>
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
        <h4 class="modal-title" id="myModalLabel">Nuevo Banco</h4>
      </div>
      <div class="modal-body">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      <form method="post"  action="{{route('banco.create')}} ">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <label for="entidad">Entidad</label>
          <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-bank"></i></span>
            <input type="text" class="form-control" name="entidad" id="entidad" placeholder="Entidad">  
          </div>
          <br>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span> Guardar</button>  
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
    <h3 class="box-title" align="text-center">Bancos</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <table class="table table-hover table-bordered" id="tablatipousuario">
    <thead>
      <tr bgcolor="#98A8D5">
        <th class="text-center">#</th>
        <th class="text-center">Entidad</th>
         <th class="text-center">Acción</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      <?php $i = 1;  ?>
      @foreach($banco as $bc)
      <tr class='text-center'>
        <td><?php echo $i; $i++; ?></td>
        <td><?php echo $bc->entidad?></td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-3">
             <form action="{{route ('banco.cambio', $bc->id)}}" method="post">
              {{csrf_field()}}
              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('banco.delete', $bc->id)}}" method="post">
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
{{ $banco->links() }}
@endsection