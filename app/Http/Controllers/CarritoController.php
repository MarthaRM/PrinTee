<?php

namespace App\Http\Controllers;

use App\Carrito;
use App\Categorias;
use App\Diseños;
use App\Productos;
use App\Subtipos;
use App\TiposProductos;
use App\User;
use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categorias::all();
        $tipos = TiposProductos::all();
        $subtipos = Subtipos::all();
        if(!session()->has('cart'))
        {
            return view('carrito', ['articulos' => null, 'categorias' => $categorias, 'tipos' => $tipos, 'subtipos' => $subtipos]);
        }
        $oldCart = session()->get('cart');
        $cart = new Carrito($oldCart);
        $articulos = $cart->articulos;
        $precioTotal = $cart->precioTotal;
        return view('carrito', compact('articulos' , 'precioTotal', 'categorias', 'tipos', 'subtipos'));
    }

    public function agregarCarrito(Request $request, $id)
    {
        $producto = Productos::find($id);
        $oldCart =  $request->session()->has('cart') ?  $request->session()->get('cart') : null;

        $carrito = new Carrito($oldCart);
        $carrito->agregar($producto, $producto->id);

        $request->session()->put('cart', $carrito);

        return redirect()->route('carrito');
    }



    public function quitarUno(Request $request, $id)
    {
        $producto = Productos::find($id);
        $oldCart =  $request->session()->has('cart') ?  $request->session()->get('cart') : null;

        $carrito = new Carrito($oldCart);
        $carrito->quitarUno($producto, $producto->id);

        $request->session()->put('cart', $carrito);

        return redirect()->route('inicio');
    }

    public function test(Request $request)
    {

        $user = User::find($request->userId);
        try {
            $response = $user->charge(100, [
                "currency" => "mxn",
                "description" => "Compra en Printee",
                "source" => $request->stripeToken,
            ]);
        } catch (Exception $e) {
            //
        }
    }
}
