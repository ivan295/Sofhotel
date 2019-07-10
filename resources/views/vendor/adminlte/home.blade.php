@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

<div class="container-fluid spark-screen" id="cuadro">
	<div class="row">
		<!--<div class="col-md-3 col-md-offset-0">
			<div class="small-box bg-aqua">
				<div id="inner" class="inner">

				</div>
			</div>
		</div>-->
	</div>
</div>


<!-- ventana para preguntar si consumio productos-->
<!-- <form method="post" action="{{route('alquiler.create')}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					 fecha
					<input type="hidden" class="form-control" name="fecha" id="fecha" value="<?= date(' Y-m-d g:i:s ') ?>">
					 hora ingreso
					<input type="hidden" class="form-control" name="hora_ingreso" id="hora_ingreso" value="<?= date(' g:i:s') ?>">-->
<!-- hora salida
					<input type="hidden" class="form-control" name="hora_salida" id="hora_salida" value="<?= date(' g:i:s') ?>">				
					 tiempo-
					<input type="hidden" class="form-control" name="tiempo_alquiler" id="tiempo_alquiler" value="00:34:00">

					<input type="hidden" class="form-control" name="numero_personas" id="numero_personas" value="2">

					<input type="hidden" class="form-control" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}">

					<input type="hidden" class="form-control" name="id_habitacion" id="id_habitacion" value="">				

					<button type="submit"class="btn  btn-block btn-warning" data-toggle="modal" data-target="#exampleModalCenter">Imprimir</button>
				</form> -->

<!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"  aria-hidden="true">
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
				</div>  -->


<!--barra de carga-->
<!-- <div class="contenedor ">
					<progress value=0 max=100 id="barra" class="barraStyle" style="width:100%" ></progress>
					{{-- <input type="button" value="cargar" id="cargar" onclick="setInterval('cargar()',1800)"/>  --}}
				</div> -->
<!-- <div class="icon">
					<i class="fa fa-hotel"></i>
				</div> -->



<script src="{{ asset('/js/llenarhome.js') }}" defer></script>
@endsection