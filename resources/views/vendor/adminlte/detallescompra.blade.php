@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Factura de Compra</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <label><strong>Descripcion : {{$Compra->descripcion}}</strong></label>
                </div>
                <div class="col-md-12">
                    <label><strong>Fecha : {{$Compra->created_at}}</strong></label>
                </div>
                <div class="col-md-4">
                    <label><strong>Total : {{$Compra->total_pagar}}</strong></label>
                </div>
                <div class="col-md-4">
                    <label><strong>Proveedor : {{$Compra->Empresa}}</strong></label>
                </div>
                <div class="col-md-4">
                    <label><strong>Usuario : {{$Compra->name}}</strong></label>
                </div>
                <div class="col-md-12">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class='text-center'>Producto</th>
                                <th class="text-center">cantidad</th>
                                <th class='text-center'>Valor Unitario</th>
                                <th class='text-center'>Subtotal</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <th>
                                <center>TOTAL</center>
                            </th>
                            <th></th>
                            <th></th>
                            <th>
                                <center>
                                    <h5 id="total">$ {{$Compra->total_pagar}}</h5>
                                </center>
                            </th>
                        </tfoot>
                        <tbody>
                            @foreach($Detalle as $details)
                            <tr class='text-center'>
                                <td>{{$details->producto}}</td>
                                <td>{{$details->cantidad}}</td>
                                <td>$ {{$details->precio_compra}}</td>
                                <td>$ {{$details->subtotal}}</td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
            <form method="GET" action="{{route('factura_compra.index')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-footer">
                    <button type="submit" class="btn btn-danger">Salir</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection