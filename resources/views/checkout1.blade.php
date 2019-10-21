@extends('layouts.master')
@section('title', 'Direccion')
@section('content')
        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{route('inicio')}}">Inicio</a>
                        </li>
                        <li>Checkout - Direccion</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="{{route('checkout2')}}">
                            {{csrf_field()}}
                            <h1>Checkout</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>Direccion</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Resumen</a>
                                </li>
                            </ul>

                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="firstname">Nombre (s)</label>
                                            <input type="text" class="form-control" id="firstname" value="{{Auth::user()->nombre}} ">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lastname">Apellidos</label>
                                            <input type="text" class="form-control" id="lastname" value="{{Auth::user()->ap}} {{Auth::user()->am}}">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->



                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="city">Direccion</label>
                                            <input type="text" class="form-control" id="direccion" value="{{Auth::user()->direccion}}">
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Teléfono</label>
                                            <input type="text" class="form-control" id="phone" value="{{Auth::user()->telefono}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" value="{{Auth::user()->email}}">
                                        </div>
                                    </div>

                                </div>
                                <!-- /.row -->
                            </div>

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="{{route('carrito')}}" class="btn btn-default"><i class="fa fa-chevron-left"></i>Regresar</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Continuar<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-md-9 -->

                <div class="col-md-3">

                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Resumen</h3>
                        </div>
                        <!--<p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>-->

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <th>${{$precioTotal}}</th>
                                </tr>
                                <tr>
                                    <td>Envio</td>
                                    <th>$0.00</th>
                                </tr>
                                <tr>
                                    <td>IVA</td>
                                    <th>$0.00</th>
                                </tr>
                                <tr class="total">
                                    <td>Total</td>
                                    <th>${{$precioTotal}}</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
@endsection