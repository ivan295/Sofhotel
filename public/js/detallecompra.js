$('#bt_add').click(function() {
  agregar();
  
});

var cont=0;
    total=0;
    subtotal=[];
    
    //indice=0;
  $("#boton").hide();

    function agregar(){
      
      idfactura=$().val("#id_factura");
      idproducto=$("#id_producto").val();
      producto=$("#id_producto option:selected").text();
      cantidad=$("#cantidad").val();
      preciocompra=$("#precio_compra").val();

      

      if (idproducto!="" && cantidad!="" && cantidad>0 && preciocompra!="") {
          subtotal[cont]=(cantidad*preciocompra);
          total=total+subtotal[cont];
          var fila='<tr class="selected" id="fila'+cont+'"><td> <button type="button" class="btn btn-danger" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name"idproducto[]" value="'+idproducto+'">'+producto+'</td><td><input type="number" name"cantidad[]" value="'+cantidad+'" disabled></td><td><input type="number" name"preciocompra[]" value="'+preciocompra+'" disabled></td><td>'+subtotal[cont]+'</td></tr>';
          cont ++;
        
          
          
          $("#arreglo").val(+array[""]);          

          $("#total").html("$" + total);
          $("#total_compra").val(+total);
          //$("#sub").val(+subtotal[cont]);
           evaluar();
           $('#detalles').append(fila);
      }else{
        alert("Error al ingresar");
      }
      
    }
  
  //function limpiar(){
    //$("#cantidad").val("");
    //$("#precio_compra").val("");

//  }

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