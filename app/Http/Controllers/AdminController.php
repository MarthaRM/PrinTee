<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Colores;
use App\Imagenes;
use App\Productos;
use App\Subtipos;
use App\TiposProductos;
use Dompdf\FrameDecorator\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Tests\Caster\CasterTest;

class AdminController extends Controller
{


    public function getProductos()
    {
        $categorias = Categorias::all();
        $tipos = TiposProductos::all();
        $subtipos = Subtipos::all();

        $productos = DB::table('productos')->paginate(10);
        $colores = Colores::all();
        $imagenes = Imagenes::all();


        return view('admin-productos', compact('categorias', 'tipos', 'subtipos', 'productos', 'colores', 'imagenes'));
    }

    public function getSubtipos()
    {
        $categorias = Categorias::all();
        $tipos = TiposProductos::all();
        $subtipos = Subtipos::all();

        $subtipo = DB::table('subtipos')->paginate(10);



        return view('admin-subtipos', compact('categorias', 'tipos', 'subtipos', 'subtipo'));
    }

    public function getTipos()
    {
        $categorias = Categorias::all();
        $tipos = TiposProductos::all();
        $subtipos = Subtipos::all();

        $tipo = DB::table('tipos_de_productos')->paginate(10);



        return view('admin-tipos', compact('categorias', 'tipos', 'tipo', 'subtipos','tipo'));
    }

    public function getCategorias()
    {
        $categorias = Categorias::all();
        $tipos = TiposProductos::all();
        $subtipos = Subtipos::all();

        $categoria = DB::table('categorias')->paginate(10);



        return view('admin-categorias', compact('categorias', 'tipos', 'subtipos','categoria'));
    }
}
