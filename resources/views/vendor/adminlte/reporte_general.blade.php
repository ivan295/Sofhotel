 

 @if (isset($date))
  <h1>Reporte general del día:<?php echo $date ?></h1>
    @elseif(isset($date_inicial))
      <h1>Reporte desde: <?php echo $date_inicial ?> hasta: <?php echo $date_final;?> </h1>
    @elseif(isset($month))
    <h1>Reporte del mes: <?php echo $month ?></h1>      
 
  @endif

<h4>Utilidad generada {{$utilidad}}</h4>
<h2>Reporte de caja</h2>
<table>
  <thead>
    <tr>
      <th>Usuario</th>
      <th>Numero de caja</th>
      <th>Fecha y hora de apertura</th>
      <th>Fecha y hora de cierre</th>
      <th>Monto inicial</th>
      <th>Monto final</th>
    </tr>
  </thead>
  <tbody>
    @foreach($caja as $caja)
    <tr>
      <td>{{$caja->usuario}}</td>
      <td>{{$caja->numero_caja}}</td>
      <td>{{$caja->created_at}}</td>
      <td>{{$caja->updated_at}}</td>
      <td>{{$caja->dinero_inicial}}</td>
      <td>{{$caja->dinero_disponible}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<h2>Reporte de egresos</h2>
<h3>Depósitos</h3>
<table>
    <thead>
      <tr>
        <th>Usuario</th>
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
      
      @foreach($depositos as $dp)
      <tr>
        <td><?php echo $dp->nombre_usuario?></td>
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
        <th>Usuario</th>
        <th>Descripcion</th>
        <th>Total de Pago</th>
        <th>Fecha y hora del Pago</th>     
      </tr>
    </thead>
    <tbody>
      
      @foreach($gasto as $Nuevogasto)
      <tr>
        <td>{{$Nuevogasto->user}}</td>
        <td>{{$Nuevogasto->descripcion}}</td>
        <td>$ {{$Nuevogasto->gasto_total}}</td>
        <td>{{$Nuevogasto->created_at}}</td>      
    </tr>
    @endforeach
    </tbody>
  </table>

  <h4>Total de gastos: <?php echo $total_gastos ?></h4>
  <h3>Compras</h3>
<table>
    <thead>
      <tr>
        <th>Usuario</th>
        <th>Proveedor</th>
        <th>Empresa</th>
        <th>Fecha</th>
        <th>Descripción de compra</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      
       @foreach($compra as $fc)
      <tr>
        <td>{{$fc->nombre}} {{$fc->apellido}}</td>
        <td>{{$fc->nombre_proveedor}} {{$fc->apellido_proveedor}}</td>
        <td>{{$fc->empresa}}</td>
        <td>{{$fc->created_at}}</td>
        <td>{{$fc->descripcion}}</td>
        <td>{{$fc->total_pagar}}</td>      
    </tr>
    @endforeach
    </tbody>
  </table>
  <h4>Total de compras: <?php echo $total_compra ?> </h4>
  <h3>Total de egresos: <?php echo $total_egresos ?></h3>

  <h2>Reporte de ingresos</h2>
  <h3>Ventas</h3>

  <table>
    <thead>
    <tr>
        <th>Usuario</th>
        <th>Número de habitación</th>
        <th>Fecha de alquiler</th>
        <th>Total alquiler</th>
        <th>Total productos consumidos</th>
        <th>Total cobro</th> 
      </tr>
    </thead>
    <tbody>
      
      @foreach($factura_venta as $fv)
      <tr>
        <td>{{$fv->nombre}} {{$fv->apellido}}</td>
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
