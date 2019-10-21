@extends('layouts.master')

@section('content')
    <div id="content">
        <div class="container">

            <div class="col-md-12">

                <ul class="breadcrumb">
                    <li><a href="{{'inicio'}}">Inicio</a>
                    </li>
                    <li>Administrador</li>
                </ul>

            </div>

            <div class="col-md-3">
                <!-- *** CUSTOMER MENU ***
_________________________________________________________ -->
                <div class="panel panel-default sidebar-menu">

                    <div class="panel-heading">
                        <h3 class="panel-title">Secciones</h3>
                    </div>

                    <div class="panel-body">

                        <ul class="nav nav-pills nav-stacked">
                            <li @yield('CA')>
                                <a href="{{route('admin-categorias')}}"><i class="fa fa-list"></i> Categorias</a>
                            </li>
                            <li @yield('CT')>
                                <a href="{{route('admin-tipos')}}"><i class="fa fa-list"></i> Tipo</a>
                            </li>
                            <li @yield('CS')>
                                <a href="{{route('admin-subtipos')}}"><i class="fa fa-list"></i> Subtipos</a>
                            </li>
                            <li @yield('CP')>
                                <a href="{{route('admin-productos')}}"><i class="fa fa-list"></i> Productos</a>
                            </li>
                            <li>
                                <a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Cerrar Sesion</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- /.col-md-3 -->

                <!-- *** CUSTOMER MENU END *** -->
            </div>
            @yield('box')

        </div>
        <!-- /.container -->
    </div>
    <!-- /#content -->


@endsection