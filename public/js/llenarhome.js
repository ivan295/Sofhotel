$(document).ready(function(){
    cargarhabitacion();
    	setInterval(cargarhabitacion,5000); //actualiza la funcion cargarhabitacion cada 5seg
         });
    function cargarhabitacion(){
           $.get('mostrar_inner', function (data) {
            var hoy =new Date();//variable hoy contiene la instancia del objeto date
            var f = new Date();
            var fecha = hoy.getDate()+ '-' +(hoy.getMonth()+1)+ '-' +hoy.getFullYear();
            var hora_ingreso=f.getHours()+":"+f.getMinutes()+":"+f.getSeconds();
            $("#cuadro").html("");//envia vacio el #cuadro para actualizar color cada 5seg
            $.each(data, function(i, item) { 
                 if (item.estado == 'Desocupado') { //consulta los datos del item.estado y retorna el color
                     var color = "<div class='small-box bg-green'>"
                 }if(item.estado == 'Ocupado'){
                     var color = "<div class='small-box bg-red'>"
                 }if (item.estado == 'Limpieza'){
                     var color = "<div class='small-box bg-aqua'>"
                 }
             $("#cuadro").append(
                "<div class='col-md-3 col-md-offset-0'>\
                "+color+"\
                <div class='inner'>\
                <h3>"+item.numero_habitacion+"</h3>\
                <p>Fecha:  "+fecha+"</p>\
                <p>Hora de ingreso: "+hora_ingreso+" </p>\
                <p>Hora de salida: </p>\
                <p>Total a pagar: </p>\
                <button type='button' id='boton' class='btn  btn-block btn-warning'>Imprimir</button>\
                </div>\
                <div class='icon'>\
                <i class='fa fa-hotel'></i>\
                </div>\
                <progress value=0 max=100 id='barra' class='barraStyle style='width:100%' ></progress>\
                </div>"
                );
                
                
         });


        });

        
}
$('#boton').click(function() {
    alert("exito");
    
  });
//});










