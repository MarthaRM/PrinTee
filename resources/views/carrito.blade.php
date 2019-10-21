
@extends('layouts.master')
@section('title', 'Carrito')
@section('content')

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{route('inicio')}}">Home</a>
                        </li>
                        <li>Carrito</li>
                    </ul>
                </div>

                <div class="col-md-9" id="basket">

                    <div class="box">



                            <h1>Carrito</h1>
                            @if(session()->has('cart'))
                                <p class="text-muted">Tienes {{session()->has('cart') ?  session()->get('cart')->cantTotal : '' }} elemento(s) agegados al carrito</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th colspan="2">Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Descuento</th>
                                            <th colspan="2">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($articulos as $articulo)
                                            @if($articulo['cant']>0)
                                            <tr>
                                                <td>
                                                    <a href="#">
                                                        <img src="{{URL::to('img/'.$articulo['item']['nombre_img'].'_square.jpg')}}" alt="">
                                                    </a>
                                                </td>
                                                <td><a href="#">{{$articulo['item']['descripcion']}}</a>
                                                </td>
                                                <td>
                                                    {{$articulo['cant']}}
                                                </td>
                                                <td>${{$articulo['item']['precio']}}</td>
                                                <td>$0.00 editar</td>
                                                <td>${{$articulo['item']['precio']*$articulo['cant']}}</td>
                                                <td><a href="{{route('eliminar-articulo', $articulo['item']['id'])}}"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            @endif
                                    @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th colspan="2">${{session()->has('cart') ?  session()->get('cart')->precioTotal : '' }}</th>
                                        </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            <div class="box-footer">

                                <div class="pull-right">
                                    <a href="{{route('checkout1')}}"><div class="btn btn-primary">Comprar<i class="fa fa-chevron-right"></i>
                                        </div></a>
                                </div>
                            </div>
                            @else

                                <p>No has agregado articulos al carrito</p>
                            <div class="box-footer">

                                <div class="pull-right ">
                                    <div class="btn btn-primary disabled">Comprar<i class="fa fa-chevron-right"></i>
                                        </div>
                                </div>
                            </div>
                            @endif





                            <!-- /.table-responsive -->





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
                                        @if(session()->has('cart'))
                                        <th>${{$precioTotal}}</th>
                                        @else
                                            <th></th>
                                            @endif

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
                                        @if(session()->has('cart'))
                                            <th>${{$precioTotal}}</th>
                                        @else
                                            <th></th>
                                        @endif
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