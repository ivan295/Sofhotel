<!DOCTYPE html>
<html>
<head>
  <title>Reporte depositos</title>

</head>


<body>



  <div>
    @if (isset($date))
  <h3>Reporte de depósitos del día: <span class="derecha"><?php echo $date ?> </span></h3>
    @elseif(isset($date_inicial))
      <h3>Reporte desde: <?php echo $date_inicial ?> hasta: <?php echo $date_final;?> </h3>
    @elseif(isset($month))
    <h3>Reporte del mes: <?php echo $month ?></h3>      
  </div>
  @endif
<div>

  <table class="table table-bordered table-striped table-sm">
    <thead>
    <tr bgcolor="#98A8D5">
        <th>#</th>
        <th>Descripcion</th>
        <th>Total de Pago</th>
        <th>Fecha y hora del Pago</th>
        <th>Usuario</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($Nuevogasto as $Nuevogasto)
      <tr>
        <td>{{$Nuevogasto->id}}</td>
        <td>{{$Nuevogasto->descripcion}}</td>
        <td>$ {{$Nuevogasto->gasto_total}}</td>
        <td>{{$Nuevogasto->created_at}}</td>
        <td>{{$Nuevogasto->user}}</td>      
    </tr>
    @endforeach

    </tbody>
  </table>
</div>

</body>
</html>
