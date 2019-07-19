@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<script type="text/javascript">
  function consultar() {
    var dato = document.getElementById('consulta_proveedor').value;
    document.getElementById('id_proveedor').value = dato;
  }
</script>
<label>
  <h3>Facturas de Compras</h3>
</label>
<div class="row">
  <br>
  <div class="col-md-5">
    <form method="GET" action="{{route('factura_compra.index')}}">
      <div class="input-group input-group-flat">
        <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Busqueda por descripción">
        <span class="input-group-btn">
          <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Buscar</button>
        </span>
      </div>
    </form>
  </div>
  <form method="GET" action="{{route('detalle_compra.index')}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="contenedor-modal">
      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Nueva Compra</button>
    </div>
  </form>
</div>
<br>
<!-- box para mostrar tabla con datos -->
<div class="col-md-14">
  <div class="box box-primary">
    <div class="box-header with-border">
      <i class="fa fa-bar-chart"></i>
      <h3 class="box-title">Listado</h3>
      <div class="box-tools pull-right">
      </div>
    </div>
    <!--tabla-->
    <table class="table table-hover table-bordered" id="tablagastos">
      <thead>
        <tr>
          <th class='text-center'>Descripcion</th>
          <th class="text-center">Fecha y hora de la compra</th>
          <th class='text-center'>Total de Pago</th>
          <th class="text-center">Proveedor</th>
          <th class="text-center">Usuario</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr></tr>
        @foreach($NuevaCompra as $NuevaCom)
        <tr class='text-center'>
          <td>{{$NuevaCom->descripcion}}</td>
          <td>{{$NuevaCom->created_at}}</td>
          <td>$ {{$NuevaCom->total_pagar}}</td>
          <td>{{$NuevaCom->Empresa}}</td>
          <td>{{$NuevaCom->name}}</td>
          <td class="text-center">

            <div class="row">
              <div class="col-md-3 col-md-offset-2">
                <form action="{{route('detalle_compra.show', $NuevaCom->id)}}" method="get">
                  {{csrf_field()}}
                  <button type="submit" class="btn btn-success btn-xs">Detalles</button></form>
              </div>
              <div class="col-md-6 text-left">
                <form action="{{route('factura_compra.delete', $NuevaCom->id)}}" method="post">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <button type="submit" class="btn btn-danger btn-xs" onclick="return borrar()">Borrar</button>
                </form>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{$NuevaCompra->links()}}
  </div>
</div>
<script src="{{ asset('/js/alerta_confirmacion.js') }}" defer></script>

@endsection