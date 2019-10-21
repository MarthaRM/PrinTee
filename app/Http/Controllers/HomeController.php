<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Productos;
use App\Subtipos;
use App\TiposProductos;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
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

        $productos = Productos::all()->sortByDesc('id')->forPage(1, 5);
        return view('index', compact('categorias', 'tipos', 'subtipos', 'productos'));
    }
}
