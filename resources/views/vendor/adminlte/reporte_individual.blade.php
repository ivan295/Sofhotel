@if(isset($fecha_inicial))
<h1>Reporte de caja del <?php echo $fecha_inicial. " a " .$fecha_final; ?></h1>
@elseif(isset($month))
<h1>Reporte de caja del mes: <?php echo $month ?></h1>
@endif
@foreach($caja as $c)

@endforeach

<h4>Usuario: <?php echo $c->usuario?> </h4>
<h4>Nombre: <?php echo $c->nombre. " " .$c->apellido ?></h4>
<h4>Utilidad total: <?php echo $utilidad ?></h4>

<h3>Caja</h3>
<table>
    <thead>
      <tr>  
        <th>Fecha y hora de ingreso</th>
        <th>Fecha y hora de salida</th>
        <th>Monto inicial</th>
        <th>Monto final</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($caja as $cash)
      <tr>
        <td><?php echo $cash->created_at?></td>
        <td><?php echo $cash->updated_at?></td>
        <td><?php echo $cash->dinero_inicial?></td>
        <td><?php echo $cash->dinero_disponible?></td>
                  
    </tr>
    @endforeach
    </tbody>
  </table>



<h2>Reporte de Egresos</h2>
<h3>Depósitos</h3>
<table>
    <thead>
      <tr>
        <th>Descripción</th>
        <th>Banco</th>
        <th>Número de cuenta</th>
        <th>Tipo de cuenta</th>
        <th>Fecha y hora</th>
        <th>Propietario</th>
        <th>Monto</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($deposito as $dp)
      <tr>
      	<td><?php echo $dp->motivo?></td>
      	<td><?php echo $dp->entidad?></td>
      	<td><?php echo $dp->num_cta?></td>
      	<td><?php echo $dp->tp_descripcion?></td>
      	<td><?php echo $dp->created_at?></td>
      	<td><?php echo $dp->nombre?></td> 
        <td><?php echo $dp->monto?></td>               
    </tr>
    @endforeach
    </tbody>
  </table>
  <h4>Total de depósitos: <?php echo $total_depositos ?> </h4>

  <h3>Gastos</h3>
  <table>
    <thead>
    <tr>
        <th>Descripcion</th>
        <th>Total de Pago</th>
        <th>Fecha y hora del Pago</th>
        <th>Usuario</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($gasto as $Nuevogasto)
      <tr>
        <td>{{$Nuevogasto->descripcion}}</td>
        <td>$ {{$Nuevogasto->gasto_total}}</td>
        <td>{{$Nuevogasto->created_at}}</td>
        <td>{{$Nuevogasto->user}}</td>      
    </tr>
    @endforeach
    </tbody>
  </table>
  <h4>Total de gastos: <?php echo $total_gastos ?></h4>
  <h3>Total de egresos: <?php echo $total_egresos ?></h3>

  <h2>Reporte de ingresos</h2>
  <h3>Ventas</h3>
  <table>
    <thead>
    <tr>
        <th>Número de habitación</th>
        <th>Fecha de alquiler</th>
        <th>Total alquiler</th>
        <th>Total productos consumidos</th>
        <th>Total cobro</th> 
      </tr>
    </thead>
    <tbody>
      
      @foreach($FacturaVenta as $fv)
      <tr>
        <td>{{$fv->habitacion}}</td>
        <td>{{$fv->created_at}}</td>
        <td>{{$fv->precio}}</td>
        <td>{{$fv->total_productos}}</td>
        <td>{{$fv->total_cobro}}</td>      
    </tr>
    @endforeach
    </tbody>
  </table>
  <h4>Total ventas: <?php echo $total_venta?></h4>
  <h3>Total ingresos: <?php echo $total_venta ?></h3>




