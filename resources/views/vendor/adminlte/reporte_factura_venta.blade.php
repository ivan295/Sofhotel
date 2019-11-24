<!DOCTYPE html>
<html>
<head>
  <title>Reporte de ventas</title>
  <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }
 
        
 
        section{
        clear: left;
        }
 

 
        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;

        }
 
        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facvendedor thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        
        }
 

         #alineado{
          text-align: center;
        }

        #borde {
          border-collapse: collapse;
          border:  1px solid black ;
        }
    </style>
</head>


<body>



  <div>
    @if (isset($date))
      <h3>Reporte de ventas del día: <span class="derecha"><?php echo $date ?> </span></h3>
    @elseif(isset($date_inicial))
      <h3>Reporte desde: <?php echo $date_inicial ?> hasta: <?php echo $date_final;?> </h3>
    @elseif(isset($month))
      <h3>Reporte de ventas del mes: <?php echo $month ?></h3>      
    @endif
      <h3>Ingreso por cada habitación</h3>
      <?php $i =0; ?>
      @foreach($habitacion as $h)
        <h5>Habitacion {{$h->numero_habitacion}}: {{$hab[$i]}} <?php $i++ ?> </h5>
      @endforeach
  </div>
  <section>
    <div>
      <table id="facvendedor">
        <thead>
          <tr id="fv">
            <th>Habitación</th>
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
            <tr id="alineado">
              <td id="borde">{{$fv->habitacion}}</td>
              <td id="borde">{{$fv->nombre}} {{$fv->apellido}}</td>
              <td id="borde">{{$fv->created_at}}</td>
              <td id="borde">{{$fv->tiempo_alquiler}}</td>
              <td id="borde">{{$fv->total_alquiler}}</td>
              <td id="borde">{{$fv->total_productos}}</td>   
              <td id="borde">{{$fv->total_cobro}}</td>   
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
</body>
</html>
