

$(document).ready(function(){
    //cargarhabitacion();
    //	setInterval(cargarhabitacion,10000);
         //});
        //function cargarhabitacion(){
           $.get('mostrar_inner', function (data) {
            $.each(data, function(i, item) { 
             $("#cuadro").append(
                "<div class='col-md-3 col-md-offset-0'>\
                <div class='small-box bg-aqua'>\
                <div class='inner'>\
                <h3>"+item.numero_habitacion+"</h3>\
                <p>Fecha: </p>\
                <p>Hora de ingreso: </p>\
                <p>Hora de salida: </p>\
                <p>Total a pagar: </p>\
                <button type='submit'class='btn  btn-block btn-warning' data-toggle='modal' data-target='#exampleModalCenter'>Imprimir</button>\
                </div>\
                <div class='icon'>\
                <i class='fa fa-hotel'></i>\
                </div>\
                <progress value=0 max=100 id='barra' class='barraStyle style='width:100%' ></progress>\
                </div>\
                </div>"

                );
         });


        });
//}
});










