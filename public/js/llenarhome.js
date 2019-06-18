$(document).ready(function(){
       		habMostrar();
       		setInterval(habMostrar, 10000);
 });

function habMostrar(){
    $.get('mostrar_inner', function (data) {
        $("#cuadro").html("");
        $.each(data, function(i, item) { //recorre el data 
            cargarInner(item); // carga los datos en la tabla
        });      
    });
}

function cargarInner(data){
	$("#cuadro").append(
        "<h3>"+# item.numero_habitacion+"</h3>\
         <p>'Fecha: </p>'\
         <p>'Hora de ingreso:'</p>\
         <p>'Hora de salida:'</p>\
         <p>'Total a pagar:'</p>\ "
    );

 
 // $('#cuadro').html('');
 //        $.each(data, function(a, item) {
 // var fila="";

 //    fila+=  	'<h3>'+# item.numero_habitacion+'</h3>';
	// fila+=      '  <p>'Fecha: '</p>';
	// fila+=      '  <p>'Hora de ingreso:'</p>';
	// fila+=      '  <p>'Hora de salida:'</p>';
	// fila+=      '  <p>'Total a pagar:'</p>';

 //    $('#cuadro').append(fila);//identificamos a lo que queremos add  #tablaDetalleProductos -> es el id de la tabla a llenar       
}





					
					
					
					
