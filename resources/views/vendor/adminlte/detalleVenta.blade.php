@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<script type="text/javascript">
    function consultar_producto() {
        var dato = document.getElementById('consulta_producto').value;
        document.getElementById('product').value = dato;
    }

    function consultar_habitacion() {
        var dato = document.getElementById('consulta_habitacion').value;
        document.getElementById('habitacion').value = dato;
    }
</script>
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Datos de Venta</h3>
            </div>
            <form method="post" action="{{route('detalle_venta.create')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="input-group">
                                <h1><span class="label label-warning"># Habitación: <?php echo $Alquiler->habitacion ?></span></h1>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <h1><span class="label label-warning">Precio de habitación : <?php echo $Alquiler->Precio ?></span></h1>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="habitacion" id="habitacion" value="<?php echo $Alquiler->habitacion ?>">
                        <input type="hidden" class="form-control" name="precio_habitacion" id="precio_habitacion" value=" <?php echo $Alquiler->Precio ?>">
                    
                        <input type="hidden" class="form-control" name="id_alquiler" id="id_alquiler" value="<?php echo $Alquiler->id; ?>">


                        <div class="col-md-2">
                            <h1><span class="label label-success" id="total_cobro"></span></h1>
                            <input type="hidden" class="form-control" name="total_c" id="total_c">

                        </div>
                    </div>

                    <br>

                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="panel-header">
                                <h4 class="box-title">Detalle de factura</h4>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Producto</label>
                                    <select class="form-control selectpicker" name="id_producto" id="id_producto" onchange="consultar_producto()" data-live-search="true">
                                        <option value="0">Seleccionar Producto</option>
                                        <?php $prod = DB::table('producto')->where('producto.estado', '=', 1)->get(); ?>
                                        @foreach($prod as $prod)
                                        <option value="{{$prod->id}}_{{$prod->stock}}_{{$prod->precio_venta}}"> <?php echo $prod->descripcion; ?> </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" id="id_producto" name="product">
                            </div>
                            <div class="col-md-2">
                                <label for="Cantidad">Cantidad</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
                                    <input type="number" class="form-control" name="pcantidad" id="pcantidad" placeholder="Cantidad">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="precio_compra">Precio de Venta</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
                                    <input type="text" disabled class="form-control" name="precio_venta" id="precio_venta" placeholder="Precio de Venta">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="precio_compra">Stock</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
                                    <input type="text" disabled class="form-control" name="stock" id="stock" placeholder="stock">
                                </div>
                            </div>
                            <input type="hidden" name="total_venta" id="total_venta">


                            <div id="venta"></div>

                            <label>-</label>
                            <div class="form-group">
                                <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                            </div>
                            <!--tabla para enviar productos-->
                            <div class="col-md-13">
                                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #98A8D5">
                                        <th>Opción</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Venta</th>
                                        <th>Subtotal</th>
                                    </thead>
                                    <tfoot>
                                        <th>TOTAL</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <h4 id="total"> 0.00</h4>
                                        </th>
                                    </tfoot>
                                    <tbody>

                                    </tbody>

                                </table>
                            </div>
                        </div>
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


<script src="{{ asset('js/detalleventa.js') }}" defer></script>

@endsection