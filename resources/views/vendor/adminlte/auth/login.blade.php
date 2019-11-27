@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
<script src="{{asset('js/app.js')}}" defer></script>
<body class="hold-transition login-page">
    <div id="app">
        <div class="login-box">
            <div class="login-logo">
                <p>HOTEL</p>
            </div><!-- /.login-logo -->

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-box-body">
        <p class="login-box-msg"> INICIA SESIÓN CON TU CUENTA</p>
        <form action="{{ url('/login') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group has-feedback">
                <input id="txtemail" type="hidden" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email" / >
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input onkeyup="llenar()" id="txtusuario" type="text" class="form-control" placeholder="Usuario" name="usuario"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Contraseña" name="password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-3">
                <input type="hidden">
              </div>
              <div class="col-xs-6">
                <button type="submit" class="btn btn-primary btn-block btn-flat">INICIAR SESIÓN</button>

              </div>
             <!-- remember me-->
                {{-- <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <!-- <label>
                            <input type="checkbox" name="remember"> {{ trans('adminlte_lang::message.remember') }}
                        </label> -->
                    </div>
                </div> --}}

            </div>
        </form>


       

    </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->
    </div>

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection

<script>
    
    $("#txtusuario").keyup(function(){
        $("#txtemail").val($("#txtusuario").val());
    });

    function llenar(){
        //alert("ffgfg");
        $("#txtemail").val($("#txtusuario").val()+'@sistema.com');
    }

</script>