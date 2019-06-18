@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
<!-- box con input para crear tipo de usuario -->
@if(session()->has('msj'))
<div class="alert alert-success">
  <a href="#" class="alert-link">{{ session('msj') }}</a>
</div>
@endif
@if(session()->has('msjerror'))
<div class="alert alert-danger">
  <a href="#" class="alert-link">Error al guardar</a>
</div>
@endif

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Crear Tipo de Usuario</h3>
      </div>
      <form method="post"  action="{{route('tipouser.create')}}" target="request">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <label for="tipousuario">Tipo de Usuario</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-users"></i></span>
            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Tipo de Usuario">
          </div>
          <br>
        </div>
        <div class="box-footer">
          <button type="submit"class="btn btn-success">Crear</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="col-md-14">
  <div class="box box-primary">
   <div class="box-header with-border">
    <i class="fa fa-bar-chart"></i>
    <h3 class="box-title" align="text-center">Tipos de Usuario</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <table class="table table-hover table-bordered" id="tablatipousuario">
    <thead>
      <tr>
        <th class='text-center'>#</th>
        <th class="text-center">Descripcion</th>
        <th class="text-center">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      @foreach($Nuevotipouser as $NuevotipoUser)
      <tr class='text-center'>
        <td>{{$NuevotipoUser->id}}</td>
        <td>{{$NuevotipoUser->descripcion}}</td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-3">
             <form action="{{route ('tipouser.editar', $NuevotipoUser->id)}}" method="post">
              {{csrf_field()}}
              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('tipouser.delete', $NuevotipoUser->id)}}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
{{ $Nuevotipouser->links() }}

@endsection
