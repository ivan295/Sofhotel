@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<script type="text/javascript">
  function consultar(){
    var dato = document.getElementById('consulta_proveedor').value;
    document.getElementById('id_proveedor').value = dato;
  }
</script>

<div class="row">
  <div class="col-md-5 col-md-offset-3" >
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Factura Compra</h3>
      </div>
      <form method="post"  action="{{route('factura_compra.create')}}" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <label for="numerohabitacion">Descripción</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción">
          </div>
          <label for="tipohabitacion">Total a Pagar</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <input type="text" class="form-control" name="total_pagar" id="total_pagar" placeholder="Total a Pagar">
          </div>
        <div class="input-group">
          <input type="hidden" class="form-control" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}">
        </div>
        <div class="form-group">
          <label>Proveedor</label>
          <select class="form-control" name="id_proveedor" id="consulta_proveedor" onchange="consultar()" required>                    
            <option value="0">Seleccionar Proveedor</option>
            <?php $prov = DB::table('proveedor')->get(); ?>
            @foreach($prov as $prov)
            <option value="<?php  echo $prov->id ; ?>"> <?php echo $prov->empresa; ?>  </option>
            @endforeach
          </select>
        </div>
        <input type="hidden" id="id_proveedor" name="id_proveedor" required>
         </div>
        <div class="box-footer">
          <button type="submit"class="btn btn-success">Crear compra</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- box para mostrar tabla con datos -->
<div class="col-md-14">
  <div class="box box-primary">
   <div class="box-header with-border">
    <i class="fa fa-bar-chart"></i>
    <h3 class="box-title" align="text-center">Facturas de Compra</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <!--tabla-->
  <table class="table table-hover table-bordered" id="tablagastos">
    <thead>
      <tr>
        <th class='text-center'>#</th>
        <th class='text-center'>Descripcion</th>
        <th class='text-center'>Total de Pago</th>
        <th class="text-center">Fecha y hora del Pago</th>
        <th class="text-center">Proveedor</th>
        <th class="text-center">Usuario</th>
        <th class="text-center">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      @foreach($NuevaCompra as $NuevaCompra)
      <tr class='text-center'>
        <td>{{$NuevaCompra->id}}</td>
        <td>{{$NuevaCompra->descripcion}}</td>
        <td>$ {{$NuevaCompra->total_pagar}}</td>
        <td>{{$NuevaCompra->created_at}}</td>
        <td>{{$NuevaCompra->Empresa}}</td>
        <td>{{$NuevaCompra->name}}</td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-2">
             <form action="" method="post">
              {{csrf_field()}}

              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('factura_compra.delete', $NuevaCompra->id)}}" method="post">
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
</div>
</div>

@endsection
