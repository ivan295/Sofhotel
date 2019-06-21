@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<script type="text/javascript">
  function consultar(){
    var dato = document.getElementById('consulta_tipo').value;
    document.getElementById('id_alquiler').value = dato;
  }
</script>
<!-- box con input para crear habitaciones -->
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Crear Usuario</h3>
      </div>
      <form method="post"  action="{{route('factura_venta.create')}}" target="request">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="box-body">
    
          <input type="hidden" class="form-control" name="total_alquiler" id="total_alquiler" value="{{Auth::user()->id}}">
      
        <div class="col-md-6">
          <label for="apellido">total de productos</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" name="total_productos" id="total_productos" placeholder="total_productos" >
          </div>
          </div>
          <div class="col-md-6">
          <label for="cedula">total cobro</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-slack"></i></span>
            <input type="text" class="form-control" name="total_cobro" id="total_cobro" placeholder="total_cobro" >
          </div>
          </div>
           <div class="col-md-6">
          <label>alquiler</label>
          <div class="select-group">
          <select class="form-control" name="id_proveedor" id="consulta_tipo" onchange="consultar()" required>                    
            <option value="0">Seleccionar Proveedor</option>
            <?php $alquiler = DB::table('alquiler')->get(); ?>
            @foreach($alquiler as $alquiler)
            <option value="<?php  echo $alquiler->id ; ?>"> <?php echo $alquiler->fecha; ?>  </option>
            @endforeach
          </select>
        </div>
      </div>
        <input type="hidden" id="id_alquiler" name="id_alquiler" required>
        </div>
        <div class="box-footer">
          <button type="submit"class="btn btn-success">Crear</button>
        </div>
        
      </form>
    </div>
  </div>
</div>


<!-- box para mostrar usuarios -->
<div class="col-md-14">
  <div class="box box-primary">
   <div class="box-header with-border">
    <i class="fa fa-picture-o"></i>
    <h3 class="box-title" align="text-center">Factura Venta</h3>
    <div class="box-tools pull-right">
    </div>
  </div> 
  <!--tabla-->
  <table class="table table-hover table-bordered" id="tablausuarios">
    <thead>
      <tr>
        <th class='text-center'>ID</th>
        <th class='text-center'>total_alquiler</th>
        <th class='text-center'>total_productos</th>
        <th class="text-center">total cobro</th>
        <th class="text-center">Fecha de Alquiler</th>
        <th class="text-center">Número de Habitación</th>
        
      </tr>
    </thead>
    <tbody>
      @foreach($FacturaVenta as $facturaVenta)
      <tr class='text-center'>
         <td>{{$facturaVenta->id}}</td>
        <td>{{$facturaVenta->Precio}}</td>
        <td>{{$facturaVenta->total_productos}}</td>
        <td>{{$facturaVenta->total_cobro}}</td>
        <td>{{$facturaVenta->Fecha}}</td>
        <td>{{$facturaVenta->habitacion}}</td>
        
      </tr>
  @endforeach
  </tbody>
</table>
</div>
</div>
{{$FacturaVenta ->links()}}
@endsection
