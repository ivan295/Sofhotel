<!DOCTYPE html>
<html>
<head>
  <title>Reporte depositos</title>
 <link rel="stylesheet" type="text/css" href=" {{ asset('/css/reporte.css') }}">
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
        <th>Usuario</th>
        <th>Monto</th>
        <th>Descripción</th>
        <th>Banco</th>
        <th>Número de cuenta</th>
        <th>Tipo de cuenta</th>
        <th>Fecha y hora del depósito</th>
        <th>Propietario</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($depositos as $dp)
      <tr>
        <td><?php echo $dp->nombre_usuario?></td>
        <td><?php echo $dp->monto?></td>
        <td><?php echo $dp->motivo?></td>
        <td><?php echo $dp->entidad?></td>
        <td><?php echo $dp->num_cta?></td>
        <td><?php echo $dp->tp_descripcion?></td>
        <td><?php echo $dp->created_at?></td>
        <td><?php echo $dp->nombre?></td>        
    </tr>
    @endforeach

    </tbody>
  </table>
</div>

</body>
</html>
