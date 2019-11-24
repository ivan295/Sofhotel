<!-- Left side column. contains the logo and sidebar -->
<?php 
$logeado = Auth::user()->id;
$usuario = DB::table('users')->where('users.id', '=', $logeado)->first();
 ?>

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
        <div class="user-panel">
            <div class="pull-left image">
               <img src="img/avatar2.png" class="img-circle" alt="User Image" />
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
        @if($usuario->idtipoUsuario == 1)
        <ul class="sidebar-menu">
            <!--<li class="header">OPCIONES</li>
             Optionally, you can add icons to the links -->
            
                <li class="active"><a href="{{ url('home') }}"><i class='glyphicon glyphicon-home'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>

                
                 <li class="treeview">
                    <a href="#"><i class='fa fa-money'></i> <span>Caja</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <?php
                            $est = DB::table('cajas')->orderBy('id', 'desc')->first();
                          ?>
                        @if($est == null || $est->estado == 0 )
                        <li ><a href="{{ url('/apertura') }}"><i class='fa fa-plus'></i> <span>Apertura</span></a></li>  
                        <li><a href="#" style="color: red"><i class='fa fa-times'></i> <span>Cierre</span></a></li>
                        @elseif($est->estado == 1)
                        <li ><a href="#" style="color: red"><i class='fa fa-plus'></i> <span>Apertura</span></a></li>  
                        <li><a href="{{ url('/cierre') }}"><i class='fa fa-times'></i> <span>Cierre</span></a></li>
                        @endif
                    </ul>
                 </li>

                 <li class="treeview">
                    <a href="#"><i class='fa fa-list-alt'></i> <span>Gestión depósito</span> <i class="fa fa-angle-left pull-right"></i></a>
                 <ul class="treeview-menu">
                    
                    <li><a href="{{ url('/propietario_cuenta') }}"><i class='fa fa-user'></i> <span>Propietario Cuenta</span></a></li>

                    <li><a href="{{ url('/tipo_cuenta') }}"><i class='fa  fa-cubes'></i> <span>Tipo de cuenta</span></a></li>

                     <li><a href="{{ url('/banco') }}"><i class='fa fa-bank'></i><span>Bancos</span></a></li>

                     <li><a href="{{ url('/cuenta') }}"><i class='fa fa-credit-card'></i> <span>Cuentas</span></a></li> 

                     <li><a href="{{ url('/deposito') }}"><i class='fa fa-file-text'></i> <span>Crear depósito</span></a></li>
                        
                 </ul>
                 </li>
                 <li><a href="{{ url('/parametros') }}"><i class='glyphicon glyphicon-wrench'></i> <span>Parámetros</span></a></li>

                <li><a href="{{ url('/Habitacion') }}"><i class='glyphicon glyphicon-wrench'></i> <span>crear habitación</span></a></li>

                <li><a href="{{ url('/gastos') }}"><i class='glyphicon glyphicon-usd'></i> <span>Gastos</span></a></li>

                <li><a href="{{ url('/tipouser') }}"><i class='fa fa-users'></i> <span>Tipo de Usuario</span></a></li>

                <li><a href="{{ url('/nuevouser') }}"><i class='fa fa-user-plus'></i> <span>Crear Usuario</span></a></li>

                <li><a href="{{ url('/proveedor') }}"><i class='fa fa-user-plus'></i> <span>Crear Proveedor</span></a></li>

                <li><a href="{{ url('/productos') }}"><i class='fa fa-object-group'></i> <span>Productos</span></a></li>

                <li><a href="{{ url('/alquiler') }}"><i class='fa  fa-exclamation'></i> <span>Alquiler</span></a></li>

                <li><a href="{{ url('/factura_venta') }}"><i class='fa fa-user-plus'></i> <span>Ventas</span></a></li>
                <li><a href="{{ url('/factura_compra') }}"><i class='fa fa-user-plus'></i> <span>Compras</span></a></li>  
            <!-- <li><a href="{{ url('/detalle_venta') }}"><i class='fa fa-user-plus'></i> <span>detalle venta</span></a></li>   -->

               <li class="treeview">
                    <a href="#"><i class='fa fa-list-alt'></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i></a>

                    <ul class="treeview-menu">
                            <li><a href="#" class="treeview"><i class='fa fa-user'></i> <span>Reportes generales</span><i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ url('/reporte_diario_general') }}"><i class='fa  fa-cubes'></i> <span>Reporte diario</span></a></li>
                                     <li><a href="{{ url('/reporte_mensual_general') }}"><i class='fa fa-bank'></i><span>Reporte mensual</span></a></li>
                                     <li><a href="{{ url('/reporte_especifico_general') }}"><i class='fa  fa-cubes'></i> <span>Reporte específico</span></a></li>
                                </ul>
                            </li>                       
                     </ul>

                     <ul class="treeview-menu">
                            <li><a href="#" class="treeview"><i class='fa fa-user'></i> <span>Reportes por usuario</span><i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ url('/reporte_diario_usuario') }}"><i class='fa  fa-cubes'></i> <span>Reporte diario</span></a></li>
                                     <li><a href="{{ url('/reporte_mensual_usuario') }}"><i class='fa fa-bank'></i><span>Reporte mensual</span></a></li>
                                     <li><a href="{{ url('/reporte_especifico_usuario') }}"><i class='fa  fa-cubes'></i> <span>Reporte específico</span></a></li>
                                </ul>
                            </li>                       
                     </ul>

                     <ul class="treeview-menu">
                            <li><a href="#" class="treeview"><i class='fa fa-user'></i> <span>Reportes de ventas</span><i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ url('/reporte_diario_fac_vent') }}"><i class='fa  fa-cubes'></i> <span>Reporte diario</span></a></li>
                                     <li><a href="{{ url('/reporte_mensual_fac_vent') }}"><i class='fa fa-bank'></i><span>Reporte mensual</span></a></li>
                                     <li><a href="{{ url('/reporte_especifico_fac_vent') }}"><i class='fa  fa-cubes'></i> <span>Reporte específico</span></a></li>
                                </ul>
                            </li>                       
                     </ul>

                     <ul class="treeview-menu">
                            <li><a href="#" class="treeview"><i class='fa fa-user'></i> <span>Reportes de compras</span><i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ url('/reporte_diario_fac_compr') }}"><i class='fa  fa-cubes'></i> <span>Reporte diario</span></a></li>
                                     <li><a href="{{ url('/reporte_mensual_fac_compr') }}"><i class='fa fa-bank'></i><span>Reporte mensual</span></a></li>
                                     <li><a href="{{ url('/reporte_especifico_fac_compr') }}"><i class='fa  fa-cubes'></i> <span>Reporte específico</span></a></li>
                                </ul>
                            </li>                       
                     </ul>

                     <ul class="treeview-menu">
                            <li><a href="#" class="treeview"><i class='fa fa-user'></i> <span>Reportes de depósitos</span><i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ url('/reporte_diario_dep') }}"><i class='fa  fa-cubes'></i> <span>Reporte diario</span></a></li>
                                     <li><a href="{{ url('/reporte_mensual_dep') }}"><i class='fa fa-bank'></i><span>Reporte mensual</span></a></li>
                                     <li><a href="{{ url('/reporte_especifico_dep') }}"><i class='fa  fa-cubes'></i> <span>Reporte específico</span></a></li>
                                </ul>
                            </li>                       
                     </ul>

                    <ul class="treeview-menu">
                            <li><a href="#" class="treeview"><i class='fa fa-user'></i> <span>Reportes de gastos</span><i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ url('/reporte_diario_gasto') }}"><i class='fa  fa-cubes'></i> <span>Reporte diario</span></a></li>
                                     <li><a href="{{ url('/reporte_mensual_gasto') }}"><i class='fa fa-bank'></i><span>Reporte mensual</span></a></li>
                                     <li><a href="{{ url('/reporte_especifico_gasto') }}"><i class='fa  fa-cubes'></i> <span>Reporte específico</span></a></li>
                                </ul>
                            </li>                       
                     </ul> 
                 </li>


     </ul><!-- /.sidebar-menu -->

     @elseif($usuario->idtipoUsuario == 2)
     <ul class="sidebar-menu">
            <!--<li class="header">OPCIONES</li>
             Optionally, you can add icons to the links -->
            
                <li class="active"><a href="{{ url('home') }}"><i class='glyphicon glyphicon-home'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>

                
                 <li class="treeview">
                    <a href="#"><i class='fa fa-money'></i> <span>Caja</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <?php
                            $est = DB::table('cajas')->orderBy('id', 'desc')->first();
                          ?>
                        @if($est == null || $est->estado == 0 )
                        <li ><a href="{{ url('/apertura') }}"><i class='fa fa-plus'></i> <span>Apertura</span></a></li>  
                        <li><a href="#" style="color: red"><i class='fa fa-times'></i> <span>Cierre</span></a></li>
                        @elseif($est->estado == 1)
                        <li ><a href="#" style="color: red"><i class='fa fa-plus'></i> <span>Apertura</span></a></li>  
                        <li><a href="{{ url('/cierre') }}"><i class='fa fa-times'></i> <span>Cierre</span></a></li>
                        @endif
                    </ul>
                 </li>

                  <li class="treeview">
                    <a href="#"><i class='fa fa-list-alt'></i> <span>Gestión depósito</span> <i class="fa fa-angle-left pull-right"></i></a>
                 <ul class="treeview-menu">
                    
                    <li><a href="{{ url('/propietario_cuenta') }}"><i class='fa fa-user'></i> <span>Propietario Cuenta</span></a></li>

                    <li><a href="{{ url('/tipo_cuenta') }}"><i class='fa  fa-cubes'></i> <span>Tipo de cuenta</span></a></li>

                     <li><a href="{{ url('/banco') }}"><i class='fa fa-bank'></i><span>Bancos</span></a></li>

                     <li><a href="{{ url('/cuenta') }}"><i class='fa fa-credit-card'></i> <span>Cuentas</span></a></li> 

                     <li><a href="{{ url('/deposito') }}"><i class='fa fa-file-text'></i> <span>Crear depósito</span></a></li>
                        
                 </ul>
                 </li>

                 <li><a href="{{ url('/gastos') }}"><i class='glyphicon glyphicon-usd'></i> <span>Gastos</span></a></li>

                 <li><a href="{{ url('/proveedor') }}"><i class='fa fa-user-plus'></i> <span>Crear Proveedor</span></a></li>

                 <li><a href="{{ url('/productos') }}"><i class='fa fa-object-group'></i> <span>Productos</span></a></li>

                <li><a href="{{ url('/alquiler') }}"><i class='fa  fa-exclamation'></i> <span>Alquiler</span></a></li>

                <li><a href="{{ url('/factura_venta') }}"><i class='fa fa-user-plus'></i> <span>Ventas</span></a></li>
                <li><a href="{{ url('/factura_compra') }}"><i class='fa fa-user-plus'></i> <span>Compras</span></a></li>  


                 


     </ul><!-- /.sidebar-menu -->
     @endif()
 </section>
 <!-- /.sidebar -->
</aside>
