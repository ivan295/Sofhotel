
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
                    var boton="disabled";
                    var button="hidden";
                    var solucion="hidden";
                    var solu="hidden";
                    var s="hidden";

                }else if(item.estado == 'Ocupado'){
                    var color = "<div class='small-box bg-red'>"
                    var button="hidden";
                    var solucion="hidden";
                    var solu="hidden";
                    var s="hidden";
                    if(item.indice == 0){
                    ingresohab(item.id,item.numero_habitacion);
                    }

                }else if (item.estado == 'Limpieza'){
                    var color = "<div class='small-box bg-aqua'>"
                    var boton ="hidden";
                    var button="hidden";
                    var solu="button";
                    var solucion="hidden";
                    var s="hidden";
                    //finalizar(item.id);

                }
                else if (item.estado == 'Espera'){
                    var color = "<div class='small-box bg-yellow'>"
                    var boton ="hidden";
                    var button="button";
                    var s="hidden";
                    var solucion="hidden";
                    var solu="hidden";
                    //garaje(item.id);

                }else if (item.estado == 'Peligro'){
                    var color = "<div class='small-box bg-purple'>"
                    var boton ="hidden";
                    var button="hidden";
                    var s="hidden";
                    alert("Puerta de garage de Habitación #" +item.numero_habitacion+ "necesita revisión manual");
                    var solucion="button";
                    var solu="hidden";
                    //soluc(item.id);
                }else if (item.estado == 'Alerta'){
                    var color = "<div class='small-box bg-brown'>"
                    var boton ="hidden";
                    var button="hidden";
                    alert("Puerta de garage de Habitación #" +item.numero_habitacion+ "necesita revisión manual");
                    var solucion="hidden";
                    var solu="hidden";
                    var s="button";
                    //soluc(item.id);
                
             $("#cuadro").append(
                "<div class='col-md-3 col-md-offset-0'>\
                "+color+"\
                <div class='inner'>\
                <h3>"+item.numero_habitacion+"</h3>\
                <p>Fecha:  "+fecha+"</p>\
                <p>Hora de ingreso: "+hora+" </p>\
                <p>Hora de salida: </p>\
                <p>Total a pagar: </p>\
                <input  type="+solucion+" value='Solucionado' onclick='soluc("+item.id+");' class='btn  btn-block btn-success'>\
                <input  type="+solu+" value='Finalizar' onclick='finalizar("+item.id+")' class='btn  btn-block btn-success'>\
                <input  type="+button+" value='Abrir Puerta' onclick='garaje("+item.id+");' class='btn  btn-block btn-success'>\
                <input  "+boton+" type="+boton+" value='Imprimir' onclick='salida("+item.id+","+item.numero_habitacion+","+item.id+")' class='btn  btn-block btn-warning'>\
                <input  type="+button+" value='Solucionado' onclick='personas("+item.id+");' class='btn  btn-block btn-success'>\
                <div class='icon'>\
                <i class='fa fa-hotel'></i>\
                </div>\
                </div>\
                </div>"
                ); 
         });
        });
    
}

function soluc(item){
    var habitacion = item;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: './alquiler/estado',
        type:"POST",
        dataType: 'json',
        data:{habitacion},               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {  
           

        },
        error: function () {     
           mensaje = "OCURRIO UN ERROR";
              alertify.error(mensaje);
        }
    });  
}

function garaje(item){
    var habitacion = item;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: './alquiler/garaje',
        type:"POST",
        dataType: 'json',
        data:{habitacion},               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {  
           

        },
        error: function () {     
           mensaje = "OCURRIO UN ERROR";
              alertify.error(mensaje);
        }
    });  
}

function finalizar(item){
    var habitacion = item;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: './alquiler/finalizar',
        type:"POST",
        dataType: 'json',
        data:{habitacion},               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {  
           

        },
        error: function () {     
           mensaje = "OCURRIO UN ERROR";
              alertify.error(mensaje);
        }
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
             


    
    

 










