$(document).ready(function(){
    cargarhabitacion();
    	setInterval(cargarhabitacion,5000); //actualiza la funcion cargarhabitacion cada 5seg
           
    });
    function cargarhabitacion(){
           $.get('mostrar_inner', function (data) {
            var hoy =new Date();//variable hoy contiene la instancia del objeto date
            var f = new Date();
            var fecha = hoy.getDate()+ '/' +(hoy.getMonth()+1)+ '/' +hoy.getFullYear();
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
                <button type='button'onclick='ingreso("+item.id+")' class='btn  btn-block btn-warning'>Imprimir</button>\
                <div class='icon'>\
                <i class='fa fa-hotel'></i>\
                </div>\
                </div>\
                </div>"
                );           
         });
        });
        
        
}

function ingreso(item){
    var hoy =new Date();
    var f = new Date();
    var fecha = hoy.getFullYear()+"-"+(hoy.getMonth()+1)+"-"+hoy.getDate();
    var hora_ingreso=f.getHours()+":"+f.getMinutes()+":"+f.getSeconds();
     
             var id =item;
             var hora = hora_ingreso;
             var ingreso = fecha;
    // alert(id,numero_habitacion,precio,hora,fecha_ingreso);

           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: './alquiler',
                type:"POST",
                dataType: 'json',
                data:{id,hora,ingreso},               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
                success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
                {  
                   

                },
                error: function () {     
                   mensaje = "OCURRIO UN ERROR";
                      alertify.error(mensaje);
                }
            });  
            //window.location = "{ url('/detalle_venta') }";


                 }

 










