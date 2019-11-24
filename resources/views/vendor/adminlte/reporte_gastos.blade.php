<!DOCTYPE html>
<html>
<head>
  <title>Reporte depositos</title>

</head>

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
      <h3>Reporte de depósitos del día: <span class="derecha"><?php echo $date ?> </span></h3>
    @elseif(isset($date_inicial))
      <h3>Reporte desde: <?php echo $date_inicial ?> hasta: <?php echo $date_final;?> </h3>
    @elseif(isset($month))
      <h3>Reporte del mes: <?php echo $month ?></h3>      
    @endif
    <h3>Total gastos: {{$total_gasto}}</h3>
  </div>
<div>
  <section>
    <table id="facvendedor">
      <thead>
        <tr id="fv">
            <th>Descripcion</th>
            <th>Usuario</th>
            <th>Fecha y hora del Pago</th>
            <th>Total de Pago</th>
        </tr>
      </thead>
    <tbody>
      
    @foreach($Nuevogasto as $Nuevogasto)
      <tr id="alineado">
        <td id="borde">{{$Nuevogasto->descripcion}}</td>
        <td id="borde">{{$Nuevogasto->user}}</td>  
        <td id="borde">{{$Nuevogasto->created_at}}</td>
        <td id="borde">{{$Nuevogasto->gasto_total}}</td>        
      </tr>
    @endforeach

    </tbody>
    </table>
  </section>
</div>

</body>
</html>
