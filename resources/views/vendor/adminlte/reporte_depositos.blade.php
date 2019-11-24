<!DOCTYPE html>
<html>
<head>
  <title>Reporte depositos</title>
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
      <h3>Total de depósitos: {{ $total_dep }}</h3>
    @elseif(isset($date_inicial))
      <h3>Reporte desde: <?php echo $date_inicial ?> hasta: <?php echo $date_final;?> </h3>
      <h3>Total de depósitos: {{ $total_dep }}</h3>
    @elseif(isset($month))
    <h3>Reporte de depósitos del mes: <?php echo $month ?></h3>
    <h3>Total de depósitos: {{ $total_dep }}</h3>      
  </div>
  @endif
  <section>
    <div>

      <table id="facvendedor">
        <thead>
          <tr id="fv">
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
          <?php $total_dep = 0; ?>
          @foreach($depositos as $dp)
          <tr id="alineado">
            <td id="borde"><?php echo $dp->nombre_usuario?></td>
            <td id="borde"><?php echo $dp->monto?></td>
            <?php $total_dep = $total_dep + $dp->monto; ?>
            <td id="borde"><?php echo $dp->motivo?></td>
            <td id="borde"><?php echo $dp->entidad?></td>
            <td id="borde"><?php echo $dp->num_cta?></td>
            <td id="borde"><?php echo $dp->tp_descripcion?></td>
            <td id="borde"><?php echo $dp->created_at?></td>
            <td id="borde"><?php echo $dp->nombre?></td>        
            </tr>
          @endforeach
          
        </tbody>
      </table>
    </div>
  </section>
</body>
</html>
