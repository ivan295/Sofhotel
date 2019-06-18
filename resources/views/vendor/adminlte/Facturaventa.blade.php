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
      <form method="post"  action="{{route('factura_venta.create')}}" target="request">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="box-body">
        @foreach($FacturaVenta as $FacturaVenta)
          <input type="hidden" class="form-control" name="total_alquiler" id="total_alquiler" value="<?php echo $FacturaVenta->Precio; ?>" >
        @endforeach
         
        <div class="col-md-6">
          <label for="apellido">Apellido</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" name="total_productos" id="total_productos" placeholder="total_productos" >
          </div>
          </div>
          <div class="col-md-6">
          <label for="cedula">Cédula</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-slack"></i></span>
            <input type="text" class="form-control" name="total_cobro" id="total_cobro" placeholder="total_cobro" >
          </div>
          </div>
          
          <div class="col-md-6">
          <div class="form-group">
            <label>Tipo de Usuario</label>
            <select class="form-control" name="idtipouser" id="consulta_tipo" onchange="consultar()">                    
              <option value="0">Seleccionar tipo de Usuario</option>
              <?php $Alquiler = DB::table('alquiler')->get(); ?>
              @foreach($Alquiler as $Alquiler)
              <option value="<?php  echo $Alquiler->id ; ?>"> <?php echo $Alquiler->fecha; ?>  </option>
              @endforeach
            </select>
          </div>
          <input type="hidden" id="idtipo" name="id_alquiler">
        </div>
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
    <h3 class="box-title" align="text-center">Usuarios</h3>
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
        <th class="text-center">habitacion</th>
        <th class="text-center">precio</th>
        
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      
      <tr class='text-center'>
         <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-center">
          <div class="row">
          </div>
        </div>
        <div class="row">
              <div class="col-md-3 col-md-offset-2">
               <form action="" method="post">
                {{csrf_field()}}
                
                <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>

              </div>
              <div class="col-md-3">
               <form action="" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger btn-xs">Borrar</button>
              </form>
            </div>
          </div>
      </td>
    </tr>
  
  </tbody>
</table>

</div>
</div>

@endsection
