<!DOCTYPE html>
<html>
<head>
  <title>Reporte individual</title>
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

         #alineado2{
          text-align: center;
          border:  1px solid black ;
          background: green ;
        }

        #borde {
          border-collapse: collapse;
          border:  1px solid black ;
        }
    </style>

</head>


<body>

</head>
<body>

  <div>
    @if (isset($date))
      <h1>Reporte general del día:<?php echo $date ?></h1>
    @elseif(isset($date_inicial))
      <h1>Reporte desde: <?php echo $date_inicial ?> hasta: <?php echo $date_final;?> </h1>
    @elseif(isset($month))
      <h1>Reporte del mes: <?php echo $month ?></h1>      
    @endif
    @foreach($caja as $c)

    @endforeach
    <h4>Usuario: <?php echo $c->usuario?> </h4>
    <h4>Nombre: <?php echo $c->nombre. " " .$c->apellido ?></h4>
    <h3>Total ingresos: <?php echo $total_venta ?></h3>
    <h3>Total de egresos: <?php echo $total_egresos ?></h3>
    <h4>Utilidad total: <?php echo $utilidad ?></h4>
  </div>

<div>
  <section>
    
  <table id="facvendedor">
    <thead>
      <tr id="fv">
        <th></th>
        <th><h2>Caja</h2></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <thead>
      <tr id="fv">  
        <th>Fecha y hora de ingreso</th>
        <th>Fecha y hora de salida</th>
        <th>Monto inicial</th>
        <th>Monto final</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($caja as $cash)
      <tr id="alineado">
        <td id="borde"><?php echo $cash->created_at?></td>
        <td id="borde"><?php echo $cash->updated_at?></td>
        <td id="borde"><?php echo $cash->dinero_inicial?></td>
        <td id="borde"><?php echo $cash->dinero_disponible?></td>                  
      </tr>
    @endforeach
    </tbody>
  </table>

  </section>
</div>

<div>
  <section>
    <h1>Reporte de Egresos</h1>
    <table id="facvendedor">
      <thead>
        <tr id="fv">
          <th></th>
          <th></th>
          <th></th>
          <th><h2>Depósitos</h2></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <thead>
        <tr id="fv">
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
        <tr id="alineado">
          <td id="borde"><?php echo $dp->motivo?></td>
          <td id="borde"><?php echo $dp->entidad?></td>
          <td id="borde"><?php echo $dp->num_cta?></td>
          <td id="borde"><?php echo $dp->tp_descripcion?></td>
          <td id="borde"><?php echo $dp->created_at?></td>
          <td id="borde"><?php echo $dp->nombre?></td> 
          <td id="borde"><?php echo $dp->monto?></td>               
        </tr>
        @endforeach
        <tr id="alineado2">
          <td>Total depósitos</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>$<?php echo $total_depositos ?></td>
        </tr>
      </tbody>
  </table>
</section>
</div>


<div>
  <section>
    <table id="facvendedor">
      <thead>
        <tr id="fv">
          <th></th>
          <th><h2>Gastos</h2></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <thead>
        <tr id="fv">
          <th>Descripcion</th>
          <th>Fecha y hora del Pago</th>
          <th>Usuario</th>
          <th>Total de Pago</th>
        </tr>
      </thead>

      <tbody>
      
        @foreach($gasto as $Nuevogasto)
        <tr id="alineado">
          <td id="borde">{{$Nuevogasto->descripcion}}</td>
          <td id="borde">{{$Nuevogasto->created_at}}</td>
          <td id="borde">{{$Nuevogasto->user}}</td>   
          <td id="borde">$ {{$Nuevogasto->gasto_total}}</td>   
        </tr>
        @endforeach
        <tr id="alineado2">
          <td>Total de gastos:</td>
            <td></td>
            <td></td>
            <td>$<?php echo $total_gastos ?></td>
        </tr>
      </tbody>
    </table>
  </section>
</div>


<div>
  <section>
    <table id="facvendedor">
      <thead>
        <tr id="fv">
          <th></th>
          <th></th>
          <th><h2>Compras</h2></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
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
        <tr id="alineado2">
          <td>Total de compras</td>          
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>$<?php echo $total_compra ?></td>
        </tr>
      </tbody>
    </table>
  </section>
</div>

<div>
  <section>
  <h1>Reporte de ingresos</h1>
  <table id="facvendedor">
    <thead>
      <tr id="fv">
        <th></th>
        <th></th>
        <th><h2>Ventas</h2></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <thead>
      <tr id="fv">
        <th>Número de habitación</th>
        <th>Fecha de alquiler</th>
        <th>Total alquiler</th>
        <th>Total productos consumidos</th>
        <th>Total cobro</th> 
      </tr>
    </thead>

    <tbody>  
      @foreach($FacturaVenta as $fv)
      <tr id="alineado">
        <td id="borde">{{$fv->habitacion}}</td>
        <td id="borde">{{$fv->created_at}}</td>
        <td id="borde">{{$fv->precio}}</td>
        <td id="borde">{{$fv->total_productos}}</td>
        <td id="borde">{{$fv->total_cobro}}</td>      
      </tr>
      @endforeach
      <tr id="alineado2">
        <td>Total ventas: </td>
        <td></td>
        <td></td>
        <td></td>
        <td>$<?php echo $total_venta?></td>
      </tr>
    </tbody>
  </table>
  
  </section>
</div> 
</body>
</html>




