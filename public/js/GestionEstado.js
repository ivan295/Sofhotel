$(document).ready(function()
       {
       		EstadoMostrar();
       		setInterval(EstadoMostrar, 10000);
          //EstadoMostrar();
 });

function EstadoMostrar(){
    $.get('consult_estado', function (data) {  //consult_estado -< nombre de la ruta
        $("#tablaestados").html("");
        $.each(data, function(i, item) { //recorre el data 
            cargartabla_estados(item); // carga los datos en la tabla
        });      
    });
}

function cargartabla_estados(data){
  

    $("#tablaestados").append(
        "<tr id='fila_cod'>\
         <td>"+ data.id +"</td>\
         <td>"+ data.contador +"</td>\
         </tr>"
    );
}