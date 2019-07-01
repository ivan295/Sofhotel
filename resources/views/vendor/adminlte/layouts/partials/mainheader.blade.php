<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        HOTEL
    </a>
    <?php
    date_default_timezone_set('America/Guayaquil');

    ?>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"></span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <!-- inner menu: contains the messages -->
                    <ul class="dropdown-menu">


                        <ul class="menu">
                            <li><!-- start message -->
                                <a href="#">
                                    <div class="pull-left">
                                        <!-- User Image -->
                                        
                                    </div>
                                    <!-- Message title and timestamp -->

                                    <!-- The message -->
                                </a>
                            </li><!-- end message -->
                        </ul>
                    </li><!-- /.menu -->

                </ul>
            </li><!-- /.messages-menu -->

            <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">
               
            </li>
            <!-- Tasks Menu -->
            <li class="dropdown tasks-menu">
                <!-- Menu Toggle Button -->

                <ul class="dropdown-menu">

                    <li>
                        <!-- Inner menu: contains the tasks -->
                        <ul class="menu">
                            <li><!-- Task item -->
                                <a href="#">
                                    <!-- Task title and progress text -->
                                    <h3>

                                    </h3>
                                    <!-- The progress bar -->

                                </a>
                            </li><!-- end task item -->
                        </ul>
                    </li>

                </ul>
            </li>
            @if (Auth::guest())
            <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
            <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
            @else
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                   
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">{{ Auth::user()->nombre }}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- The user image in the menu -->
                    <li class="user-header">
                        <img src="img/avatar2.png" class="img-circle" alt="User Image" />
                        <p>
                            {{ Auth::user()->nombre }}
                            <small><?=date(' d/m/Y  g:i a ')?></small>
                        </p>
                    </li>
                            <!-- Menu Body
                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('adminlte_lang::message.followers') }}</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('adminlte_lang::message.sales') }}</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('adminlte_lang::message.friends') }}</a>
                                </div>
                            </li>
                            Menu Footer-->
                            <li class="user-footer">
                              <!--
                                <div class="pull-left">
                                    <a href="{{ url('/settings') }}" class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.profile') }}</a>
                                </div>-->
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Cerrar Sesión
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    <input type="submit" value="logout" style="display: none;">
                                </form>

                            </div>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Control Sidebar Toggle Button -->

            </ul>
        </div>
    </nav>
</header>
