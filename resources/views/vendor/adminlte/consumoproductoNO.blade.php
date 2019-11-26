@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Total a pagar</h3>
            </div>
            <form method="post" action="{{route('consumo_no.create')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="input-group">
                                <h1><span class="label label-warning"># Habitación: <?php echo $Alquiler->habitacion ?></span></h1>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <h1><span class="label label-warning">Tiempo: <?php echo $Alquiler->tiempo_alquiler ?></span></h1>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <h1><span class="label label-warning">IVA: <?php echo $iva ?></span></h1>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <h1><span class="label label-warning">Subtotal: <?php echo $subtotal ?></span></h1>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <h1><span class="label label-success">Total: $ <?php echo $tarifa ?></span></h1>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="id_habitacion" id="id_habitacion" value="<?php echo $Alquiler->hab ?>">
                        <input type="hidden" class="form-control" name="habitacion" id="habitacion" value="<?php echo $Alquiler->habitacion ?>">
                        <input type="hidden" class="form-control" name="precio_habitacion" id="precio_habitacion" value=" <?php echo $Alquiler->Precio ?>">
                        <input type="hidden" class="form-control" name="id_alquiler" id="id_alquiler" value="<?php echo $Alquiler->id; ?>">
                        <input type="hidden" class="form-control" name="iva" id="iva" value="<?php echo $iva ?>">
                        <input type="hidden" class="form-control" name="subtotal" id="subtotal" value="<?php echo $subtotal ?>">
                        <input type="hidden" class="form-control" name="tarifa" id="tarifa" value="<?php echo $tarifa ?>">

                        <!-- <div class="col-md-2">
                            <h1><span class="label label-success" id="total_cobro"></span></h1>
                        </div> -->
                    </div>

                    <div class="col-md-3" id="boton">
                        <div class="box-footer">
                            <button id="guardar" type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>

            </form>
        </div>
    </div>
</div>
@endsection