@extends('adminlte::layouts.app')
@section('htmlheader_title')

{{ trans('adminlte_lang::message.home') }}

@endsection


@section('main-content')
<!-- box con input para crear tipo de usuario -->
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Modificar banco</h3>
      </div>
      <form method="post"  action="{{route('banco.update', $banco_mod->id)}}">
        {{csrf_field()}}
           {{method_field('PUT')}}
        <div class="box-body">
          <label for="entidad">Entidad</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
            <input type="text" class="form-control" name="entidad" id="entidad" value="<?php echo $banco_mod->entidad ?>">  
          </div>
          <br>
        </div>
        <div class="box-footer">
          <button type="submit"class="btn btn-success">Modificar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="col-md-14">
  <div class="box box-primary">
   <div class="box-header with-border">
    <i class="fa fa-bar-chart"></i>
    <h3 class="box-title" align="text-center">Bancos</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <table class="table table-hover table-bordered" id="tablatipousuario">
    <thead>
      <tr>
        <th class="text-center">#</th>
        <th class="text-center">Entidad</th>
         <th class="text-center">Acción</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      <?php $i = 1;  ?>
      @foreach($banco as $bc)
      <tr class='text-center'>
        <td><?php echo $i; $i++; ?></td>
        <td><?php echo $bc->entidad?></td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-3">
             <form action="{{route ('banco.cambio', $bc->id)}}" method="post">
              {{csrf_field()}}
              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('banco.delete', $bc->id)}}" method="post">
                {{csrf_field()}}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger btn-xs">Borrar</button>
              </form>
            </form>
          </div>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
