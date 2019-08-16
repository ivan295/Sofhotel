
<h1>Reporte de caja</h1>

<h4>Usuario: <?php echo $caja->usuario?> </h4>
<h4>Fecha y hora de ingreso: <?php echo $caja->created_at ?> </h4>
<h4>Fecha y hora de salida: <?php echo $caja->updated_at ?></h4>
<h4>Monto inicial: <?php echo $caja->dinero_inicial ?></h4>
<h4>Monto final: <?php echo $caja->dinero_disponible ?></h4>
<h4>Utilidad total: <?php echo $utilidad ?></h4>

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




