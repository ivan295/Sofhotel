<!DOCTYPE html>
<html>
<head>
  <title>Reporte de compras</title>

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
  <h2>Total de compras: {{$total}}</h2>
  <table class="table table-bordered table-striped table-sm">
    <thead>
    <tr bgcolor="#98A8D5">
        <th>Usuario</th>
        <th>Empresa</th>
        <th>Fecha</th>
        <th>Descripción de compra</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($compra as $fc)
      <tr>
        <td>{{$fc->nombre_proveedor}} {{$fc->apellido_proveedor}}</td>
        <td>{{$fc->empresa}}</td>
        <td>{{$fc->created_at}}</td>
        <td>{{$fc->descripcion}}</td>
        <td>{{$fc->total_pagar}}</td>      
    </tr>
    @endforeach

    </tbody>
  </table>
</div>

</body>
</html>
