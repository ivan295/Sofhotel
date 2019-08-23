@extends('adminlte::layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

<div class="container-fluid spark-screen" id="cuadro">
	<div class="row">
		
	</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="ventanamodal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					<center>¿EL CLIENTE CONSUMIÓ PRODUCTOS?</center>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">X</span>
				</button>
			</div>
			<div class="modal-body">
				<center>
					<form method="get" action="{{route('detalle_venta.index')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-md-6">
							<button type="submit" class="btn btn-sm btn-primary">SI</button>
						</div>
					</form>

					<form method="get" action="{{route('consumo_no.index')}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-md-6">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" class="btn btn-sm btn-primary">NO</button>
						</div>
					</form>
				</center>
			</div>
			<div class="modal-body">

			</div>
		</div>
	</div>
</div>



<script src="{{ asset('/js/llenarhome.js') }}" defer></script>
@endsection