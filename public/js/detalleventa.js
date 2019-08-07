$(document).ready(function() {
    $('#bt_add').click(function() {
        agregar();
    });
});

var cont = 0;
total = 0;
total_cob = 0;
subtotal = [];
$("#boton").hide();
$("#id_producto").change(mostrarValores);
$("#id_habitacion").change(preciohab);



function mostrarValores() {
    datos = document.getElementById('id_producto').value.split('_');
    $("#stock").val(+datos[1]);
    $("#precio_venta").val("$" + datos[2]);
}

function agregar() {
    datos = document.getElementById('id_producto').value.split('_');
    idproducto = datos[0];
    producto = $("#id_producto option:selected").text();
    cantidad = $("#pcantidad").val();
    habitacion = $("#habitacion").val();
    precio = $("#precio_habitacion").val();
    precioventa = datos[2];
    cant=parseInt(cantidad);
    stock = datos[1];
    st=parseInt(stock);
    if (idproducto != "" && cantidad != "" && cantidad > 0 && precioventa != "") {
        if (cant <= st) {
        subtotal[cont] = (cantidad * precioventa);
        total = total + subtotal[cont];
        total_cob = parseFloat(total) + parseFloat(precio);
        var fila = '<tr class="selected" id="fila' + cont + '"><td> <button type="button" class="btn btn-danger" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name"idproducto" value="' + idproducto + '">' + producto + '</td><td><input type="number" name"cantidad[]" value="' + cantidad + '" disabled></td><td><input type="number" name"precioventa[]" value="' + precioventa + '" disabled></td><td>$' + subtotal[cont] + '</td></tr>';
        cont++;
        $("#total").html("$" + total);
        $("#total_cobro").html("TOTAL : $ " + total_cob);
        $("#total_venta").val(+ total);
        $("#total_c").val(+ total_cob);
        evaluar();
        $('#detalles').append(fila);
        ///este para un array
        var x = document.createElement("INPUT");
        x.setAttribute("type", "hidden");
        x.setAttribute("name", "productoid[]");
        x.setAttribute("value", idproducto);
        $('#venta').append(x);
        //este para el otro array que quieres enviar
        var x = document.createElement("INPUT");
        x.setAttribute("type", "hidden");
        x.setAttribute("name", "precioventa[]");
        x.setAttribute("value", precioventa);
        $('#venta').append(x);

        var x = document.createElement("INPUT");
        x.setAttribute("type", "hidden");
        x.setAttribute("name", "cantidad[]");
        x.setAttribute("value", cantidad);
        $('#venta').append(x);

        } else {
          alert("La cantidad a vender es mayor que el stock");

        }


    } else {
        alert("Error al ingresar");
    }
    //limpiar();
}

function limpiar() {
    $("#pcantidad").val("");

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