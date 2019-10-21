<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Productos;
use App\Subtipos;
use App\TiposProductos;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function editar(Request $request, $id = null)
    {
        //$file = $request->file('img_ppl[]');
//        dd($file);
        $producto = Categorias::all()->find($id);

        if($request->descripcion != '')
            $producto->descripcion = $request->descripcion;

        //$producto->nombre_img = $file->getClientOriginalName();
        $producto->save();

        return redirect()->route('admin-categorias');
    }

    public function crear(Request $request)
    {
        $subtipo = new Categorias();
        $subtipo->descripcion = $request->descripcion;
        $subtipo->save();
        return redirect()->route('admin-categorias');
    }

    public function eliminar($id)
    {
        $categoria = Categorias::all()->find($id);
        $tipos = TiposProductos::all()->where('id_categoria', '=', $categoria->id);
        foreach ($tipos as $tipo)
        {
            $subtipos = Subtipos::all()->where('id_tipo', '=', $tipo->id);
            foreach ($subtipos as $subtipo)
            {
                $productos = Productos::all()->where('id_subtipo', '=', $subtipo->id);
                foreach ($productos as $producto)
                    $producto->delete();
                $subtipo->delete();
            }
            $tipo->delete();
        }
        $categoria->delete();
        return redirect()->route('admin-categorias');
    }
}
