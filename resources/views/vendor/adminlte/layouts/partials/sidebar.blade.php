<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
            </div>
        </div>
        @endif

        <!-- search form (Optional)
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder=".."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">OPCIONES</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='glyphicon glyphicon-home'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li><a href="{{ url('/Habitacion') }}"><i class='glyphicon glyphicon-wrench'></i> <span>crear habitacion</span></a></li>
            <li><a href="{{ url('/gastos') }}"><i class='glyphicon glyphicon-usd'></i> <span>Gastos</span></a></li>
            <li><a href="{{ url('/tipouser') }}"><i class='fa fa-users'></i> <span>Tipo de Usuario</span></a></li>
            <li><a href="{{ url('/nuevouser') }}"><i class='fa fa-user-plus'></i> <span>Crear Usuario</span></a></li>
            <li><a href="{{ url('/proveedor') }}"><i class='fa fa-user-plus'></i> <span>Crear Proveedor</span></a></li>
            <li><a href="{{ url('/productos') }}"><i class='fa fa-user-plus'></i> <span>Agregar Producto</span></a></li>
            <li><a href="{{ url('/alquiler') }}"><i class='fa fa-user-plus'></i> <span>Alquiler</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Compras</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                 <li><a href="{{ url('/factura_compra') }}"><i class='fa fa-user-plus'></i> <span>Factura de Compra</span></a></li>  
                 <li><a href="{{ url('/detalle_compra') }}"><i class='fa fa-user-plus'></i> <span>Detalle de Compra</span></a></li> 
             </ul>
         </li> 
     </ul><!-- /.sidebar-menu -->
 </section>
 <!-- /.sidebar -->
</aside>
