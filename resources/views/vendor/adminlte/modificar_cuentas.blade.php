@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
<script type="text/javascript">

    function obtener_tipo(){
        var r = document.getElementById('tipo_cta').value;
        document.getElementById('id_tip').value = r;
    }

    function obtener_propietario(){
        var r = document.getElementById('prop').value;
        document.getElementById('id_prop').value = r;
    }

    function obtener_banco(){
        var r = document.getElementById('banc').value;
        document.getElementById('id_banc').value = r;
    }

</script>

<!-- box con input para crear tipo de usuario -->
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Modificar cuenta</h3>
      </div>
      <form method="post"  action="{{route('cuenta.update', $cuenta->id)}}">
            {{csrf_field()}}
            {{method_field('PUT')}}
        <div class="box-body">
          <label for="numero_cuenta">Numero de cuenta</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-slack"></i></span>
            <input type="text" class="form-control" name="numero_cuenta"  id="numero_cuenta" value="<?php echo $cuenta->numero_cuenta ?>" placeholder="Numero de cuenta">
          </div>
          <br>
          <label for="numero_cuenta">Tipo de cuenta</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
            <select class="form-control"  id="tipo_cta" onchange="obtener_tipo()">
              <option value="<?php echo $tipo_cuenta->id ?>"><?php echo $tipo_cuenta->descripcion ?></option>
                   <?php $tipo_cta = DB::table('tipo_cuentas')->get(); ?>
                    @foreach($tipo_cta as $tc)
                    @if($tipo_cuenta->id == $tc->id)
                    @else
                    <option value=" <?php echo $tc->id; ?>" > <?php echo $tc->descripcion; ?> </option>
                    @endif
                    @endforeach
            </select>
          </div>
          <br>
          <label for="numero_cuenta">Propietario de cuenta</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-user"></i></span>
          <select class="form-control" id="prop" onchange="obtener_propietario()">
                    <option value=" <?php echo $propietario->id ?>"> <?php echo $propietario->nombre ?> </option>
                    <?php $propietario_cuentas = DB::table('propietario_cuentas')->get(); ?>
                    @foreach($propietario_cuentas as $pc)
                    @if( $propietario->id == $pc->id )

                    @else
                    <option value="<?php echo $pc->id ?>"> <?php echo $pc->nombre; ?> </option>
                    @endif
                    @endforeach
                 </select>
          </div>
          <br>
          <label for="numero_cuenta">Banco</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <select class="form-control" id="banc" onchange="obtener_banco()">
                    <option value=" <?php echo $banco->id ?>"> <?php echo $banco->entidad ?> </option>
                    <?php $banc = DB::table('bancos')->get(); ?>
                    @foreach($banc as $b)
                    @if($banco->id == $b->id)

                    @else
                    <option value=" <?php echo $b->id ?>"> <?php echo $b->entidad; ?></option>
                    @endif
                    @endforeach
                 </select>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit"class="btn btn-success">Modificar</button>
          <input type="hidden" id="id_tip" name="id_tipo_cuenta" value= " <?php echo $tipo_cuenta->id ?>">
            <input type="hidden" id="id_prop" name="id_propietario" value= " <?php echo $propietario->id ?>">
            <input type="hidden" id="id_banc" name="id_banco" value= " <?php echo $banco->id ?>">
        </div>
      </form>
    </div>
  </div>
</div>


@endsection