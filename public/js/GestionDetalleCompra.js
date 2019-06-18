function cargarTabla(data){
	    $('#tablaDetalleProductos').html('');
        $.each(data, function(a, item) { // recorremos cada uno de los datos que retorna el objero json n valores
            
	var fila="";

    fila+=  	'<tr class="text-center">';
	fila+=      '  <td>'+item.id+'</td>';
	fila+=      '  <td>'+item.producto.descripcion+'</td>';
	fila+=      '  <td>'+item.factura_compra.descripcion+'</td>';
	fila+=      '  <td>'+item.cantidad+'</td>';
	fila+=      '  <td>'+$item.total+'</td>';
	fila+=      '  <td class="text-center">';
	fila+=      '  	<div class="row">';
	fila+=      '      	<div class="col-md-3 col-md-offset-2">';
	fila+=      '       		<form>';
	fila+=      '        			<button type="submit" class="btn btn-warning btn-xs">Editar</button>';
	fila+=      '        		</form>';
	fila+=      '      	</div>';
	fila+=      '      	<div class="col-md-6 text-left">';
	fila+=      '        		<form>';
	fila+=      '          		<button type="submit" class="btn btn-danger btn-xs">Borrar</button>';
	fila+=      '        		</form>';
	fila+=      '    		</div>';
	fila+=      '    	</div>';
	fila+=      '	</td>';
	fila+=    	'</tr>';

    $('#tablaDetalleProductos').append(//identificamos a lo que queremos add  #tablaDetalleProductos -> es el id de la tabla a llenar       
        fila									
            );
            
        });  

}
$('#txtfiltroP').keyup(function(){
	//alert("Hola");
	// var FrmData = {
 //        dato:    $('#txtfiltroP').val(),
 //    }
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'filtroProductos/'+$('#txtfiltroP').val(), // Url que se envia para la solicitud esta en el web php es la ruta
        method: "GET",             // Tipo de solicitud que se enviará, llamado como método
        data: $('#txtfiltroP').val(),               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {  
        	//alert('sdsd');
			cargarTabla(data);
            //mensaje1 = "DATOS GUARDADOS CORRECTAMENTE";
            //CargarPeticiones2();     
             //alertify.success(mensaje1);
            
        },
        error: function () {     
            mensaje = "OCURRIO UN ERROR";
            alert(mensaje);
             //alertify.error(mensaje);
        }
    });  

});