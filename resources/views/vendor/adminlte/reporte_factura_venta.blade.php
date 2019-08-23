<!DOCTYPE html>
<html>
<head>
  <title>Reporte de ventas</title>

</head>


<body>



  <div>
    @if (isset($date))
  <h3>Reporte de ventas del día: <span class="derecha"><?php echo $date ?> </span></h3>
    @elseif(isset($date_inicial))
      <h3>Reporte desde: <?php echo $date_inicial ?> hasta: <?php echo $date_final;?> </h3>
    @elseif(isset($month))
    <h3>Reporte de ventas del mes: <?php echo $month ?></h3>      
  </div>
  @endif
<div>
  <h3>Ingreso por cada habitación</h3>
  <?php $i =0; ?>
  @foreach($habitacion as $h)
    <h4>Habitacion {{$h->numero_habitacion}}: {{$hab[$i]}} <?php $i++ ?> </h4>
  @endforeach
  <table class="table table-bordered table-striped table-sm">
    <thead>
    <tr bgcolor="#98A8D5">
        <th>Numero de habitación</th>
        <th>Usuario</th>
        <th>Fecha y hora de alquiler</th>
        <th>Tiempo de estadía</th>
        <th>Total alquiler</th>
        <th>Total productos</th>
        <th>Total a cobrar</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($factura_venta as $fv)
      <tr>
        <td>{{$fv->habitacion}}</td>
        <td>{{$fv->nombre}} {{$fv->apellido}}</td>
        <td>{{$fv->created_at}}</td>
        <td>{{$fv->tiempo_alquiler}}</td>
        <td>{{$fv->total_alquiler}}</td>
        <td>{{$fv->total_productos}}</td>   
        <td>{{$fv->total_cobro}}</td>   
    </tr>
    @endforeach

    </tbody>
  </table>
</div>

</body>
</html>
