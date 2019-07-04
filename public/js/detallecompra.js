  $(document).ready(function(){
    $('#bt_add').click(function(){
      agregar();
    });
  });

    var cont=0;
    total=0;
    subtotal=[];
    $("#boton").hide();

    function agregar(){
      idproducto=$("#id_producto").val();
      producto=$("#id_producto option:selected").text();
      cantidad=$("#cantidad").val();
      preciocompra=$("#precio_compra").val();
      precioventa=$("#precio_venta").val();

      if (idproducto!="" && cantidad!="" && cantidad>0 && preciocompra!="" && precioventa!="") {
          subtotal[cont]=(cantidad*preciocompra);
          total=total+subtotal[cont];
          var fila='<tr class="selected" id="fila'+cont+'"><td> <button type="button" class="btn btn-danger" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name"idproducto[]" value="'+idproducto+'">'+producto+'</td><td><input type="number" name"cantidad[]" value="'+cantidad+'" disabled></td><td><input type="number" name"preciocompra[]" value="'+preciocompra+'" disabled></td><td><input type="number" name"precioventa[]" value="'+precioventa+'"disabled></td><td>$'+subtotal[cont]+'</td></tr>';
          cont ++;
          limpiar();
          $("#total").html("$" + total);
           evaluar();
           $('#detalles').append(fila);
      }else{
        alert("Error al ingresar");
      }

    }
  
  function limpiar(){
    $("#descripcion").val("");
    $("#cantidad").val("");
    $("#precio_venta").val("");
    $("#precio_compra").val("");

  }

    function evaluar(){
      if (total>0) {
        $("#boton").show();
      }else{
        $("#boton").hide();
      }
    }

    function eliminar(index){
      total=total-subtotal[index];
      $("#total").html("$" + total);
      $("#fila" + index).remove();
      evaluar();  
    }