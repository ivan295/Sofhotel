
  $(document).ready(function() {
    debugger
    $('#bt_add').click(function() {
      agregar();
    });
  });

  var cont = 0;
  total = 0;
  subtotal = [];
  $("#boton").hide();

     data=[];
      var i=0;
      

      
  function agregar() {
    debugger
    idproducto = $("#id_producto").val();
    producto = $("#id_producto option:selected").text();
    cantidad = $("#pcantidad").val();
    preciocompra = $("#pprecio_compra").val();
      
     if (idproducto != "" && cantidad != "" && cantidad > 0 && preciocompra != "") {
      subtotal[cont] = (cantidad * preciocompra);
      total = total + subtotal[cont];
      var fila = '<tr class="selected" id="fila' + cont + '"><td> <button type="button" class="btn btn-danger" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name"idproducto" value="' + idproducto + '">' + producto + '</td><td><input type="number" name"cantidad[]" value="' + cantidad + '" disabled></td><td><input type="number" name"preciocompra[]" value="' + preciocompra + '" disabled></td><td>$'+ subtotal[cont] + '</td></tr>';
      cont++;
      $("#total").html("$" + total);
      $("#total_compra").val(+total);
  
      evaluar();
      $('#detalles').append(fila);
      // limpiar();

      ///este para un array
      var x = document.createElement("INPUT");  
      x.setAttribute("type", "hidden");
      x.setAttribute("name", "productoid[]");
      x.setAttribute("value", idproducto);
      $('#compra').append(x);
      //este para el otro array que quieres enviar
      var x = document.createElement("INPUT");  
      x.setAttribute("type", "hidden");
      x.setAttribute("name", "precioco[]");
      x.setAttribute("value", preciocompra);
      $('#compra').append(x);

      var x = document.createElement("INPUT");  
      x.setAttribute("type", "hidden");
      x.setAttribute("name", "cant[]");
      x.setAttribute("value", cantidad);
      $('#compra').append(x);
      
    } else {
      alert("Error al ingresar");
    }

  }

  function limpiar() {
    $("#pcantidad").val("");
    $("#pprecio_compra").val("");

  }

  function evaluar() {
    if (total > 0) {
      $("#boton").show();
    } else {
      $("#boton").hide();
    }
  }

  function eliminar(index) {
    total = total - subtotal[index];
    $("#total").html("$" + total);
    $("#fila" + index).remove();
    evaluar();
  }
