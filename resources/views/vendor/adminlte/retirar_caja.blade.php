@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<!-- box con input para registrar gasto -->
<div class="row">
  <div class="col-md-5 col-md-offset-3" >
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Retirar dinero</h3>
      </div>
      <form method="post"  action="retirar_dinero/crear" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <label for="dinero">Dinero en caja</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
          <?php $din = DB::table('dineros')->orderBy('id', 'desc')->first();?>
          <input class="form-control" readonly="readonly" id="dinero" type="text" name="dinero_caja" value=" <?php echo $din->dinero_disponible;?>" />
          </div>
          <br>

          <label for="dinero">Valor a retirar</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
          <input class="form-control" id="dinero" type="text" name="dinero_ingresar"/>
          </div>

      <div class="input-group">
          </div>
          <div class="input-group" >
          <!-- <input type="hidden" name="id_dinero" value=" <?php //echo $dinero->id; ?>" /> -->
          <input type="hidden" name="id_usuario" value="{{Auth::user()->id}}">
        </div class="input-group">
      <div class="box-footer">
        
        
        <button type="submit"class="btn btn-success">Ingresar</button>
      </div>

    </form>

  </div>
</div>
</div>
@endsection