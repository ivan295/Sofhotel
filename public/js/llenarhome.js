
$(document).ready(function(){
    cargarhabitacion();
    	setInterval(cargarhabitacion,5000); //actualiza la funcion cargarhabitacion cada 5seg
    });
    function cargarhabitacion(){
           $.get('mostrar_inner', function (data) {
            var hoy =new Date();
            var f = new Date();
                     var hora_ingreso=f.getHours()+":"+f.getMinutes()+":"+f.getSeconds();
                     var hora = hora_ingreso;
            var fecha = hoy.getDate()+ '/' +(hoy.getMonth()+1)+ '/' +hoy.getFullYear();
            $("#cuadro").html("");//envia vacio el #cuadro para actualizar color cada 5seg
            $.each(data, function(i, item) { 
                 if (item.estado == 'Desocupado' ) { //consulta los datos del item.estado y retorna el color
                     var color = "<div class='small-box bg-green'>"
                 }if(item.estado == 'Ocupado'){

                     var color = "<div class='small-box bg-red'>"
                     if(item.indice == 0){
                     ingresohab(item.id,item.numero_habitacion);
                     }

                 }if (item.estado == 'Limpieza'){
                     var color = "<div class='small-box bg-aqua'>"
                 }
             $("#cuadro").append(
                "<div class='col-md-3 col-md-offset-0'>\
                "+color+"\
                <div class='inner'>\
                <h3>"+item.numero_habitacion+"</h3>\
                <p>Fecha:  "+fecha+"</p>\
                <p>Hora de ingreso: "+hora+" </p>\
                <p>Hora de salida: </p>\
                <p>Total a pagar: </p>\
                <button type='button'onclick='salida("+item.id+","+item.numero_habitacion+","+item.id+")' class='btn  btn-block btn-warning'>Imprimir</button>\
                <div class='icon'>\
                <i class='fa fa-hotel'></i>\
                </div>\
                </div>\
                </div>"
                );           
         });
        });
    
}

function ingresohab(item,item2){

    var f = new Date();
    var hoy =new Date();
    var hora_ingreso=f.getHours()+":"+f.getMinutes()+":"+f.getSeconds();
    var fecha = hoy.getFullYear()+"-"+(hoy.getMonth()+1)+"-"+hoy.getDate();
    var numero_habitacion = item2;
    var habitacion= item;
    var hora = hora_ingreso;
    var fecha_ingreso = fecha;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: './alquiler/ingreso',
        type:"POST",
        dataType: 'json',
        data:{habitacion,hora,fecha_ingreso,numero_habitacion},               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {  
           

        },
        error: function () {     
           mensaje = "OCURRIO UN ERROR";
              alertify.error(mensaje);
        }
    });  
 }

function salida(item,item2,item3){
    $('#ventanamodal').modal('show');
    var f = new Date();
    var hora_salida=f.getHours()+":"+f.getMinutes()+":"+f.getSeconds();
             id =item;
             auxiliar = item2;
             hora = hora_salida;
             id=item3;
    // alert(id,numero_habitacion,precio,hora,fecha_ingreso);

           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: './alquiler/crear',
                type:"POST",
                dataType: 'json',
                data:{hora,id,auxiliar},               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
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
             


    
    

 










