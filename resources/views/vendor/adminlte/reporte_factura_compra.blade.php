<!DOCTYPE html>
<html>
<head>
  <title>Reporte de compras</title>
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
    <h3>Total de compras: {{$total}}</h3>
  </div>

<div>
  <section>
  
    <table id="facvendedor">
      <thead>
        <tr id="fv">
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
        <tr id="alineado">
          <td id="borde">{{$fc->nombre}} {{$fc->apellido}}</td>
          <td id="borde">{{$fc->nombre_proveedor}} {{$fc->apellido_proveedor}}</td>
          <td id="borde">{{$fc->empresa}}</td>
          <td id="borde">{{$fc->created_at}}</td>
          <td id="borde">{{$fc->descripcion}}</td>
          <td id="borde">{{$fc->total_pagar}}</td>      
        </tr>
      @endforeach

      </tbody>
    </table>
  </section>
</div>

</body>
</html>
