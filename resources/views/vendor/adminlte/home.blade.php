@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<?php $estado = DB::table('estado_habitacion')->get(); ?>
@foreach($estado as $estado)
<?php
if ($estado->estado == 1) {
        $color = "bg-blue";
} elseif ($estado->estado == 2) {
    $color = "bg-red";
} else {
    $color = "bg-aqua";
}
?>
@endforeach
<div class="container-fluid spark-screen">
		<div class="row">
		@foreach($NuevaH as $NuevaH)
		<div class="col-md-3 col-md-offset-0">
			<div class="small-box <?php echo($color)?>">
				<div class="inner">
					<h3># {{$NuevaH->numero_habitacion}}</h3>
					<p>Fecha:</p>
					<p>Hora de ingreso:</p>
					<p>Hora de salida:</p>
					<p>Total a pagar:</p>
					<button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModalCenter">IMPRIMIR</button>
					<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="exampleModalCenterTitle" style=color:black;>¿CONSUMO DE PRODUCTOS?</h4>
								</div>
								<center>
									<div class="modal-body">
										<button type="button" class="btn btn-success" data-toggle="modal" data-target="#si">SI</button>
										<button type="button" class="btn btn-success">NO</button>
									</div>
								</center>
							</div>
						</div>
					</div>
					
					</div>
					<!--barra de carga-->	
					<div class="contenedor ">
						<progress value=0 max=100 id="barra" class="barraStyle" style="width:100%" ></progress>
						{{-- <input type="button" value="cargar" id="cargar" onclick="setInterval('cargar()',1800)"/>  --}}
					</div>
				<div class="icon">
              <i class="fa fa-hotel"></i>
            </div>
           
			</div>
 				
		</div>
		@endforeach
	</div>
</div>

@endsection
