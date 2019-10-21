<?php

namespace App\Http\Controllers;

use App\Productos;
use App\Subtipos;
use Illuminate\Http\Request;

class SubtiposController extends Controller
{
    public function editar(Request $request, $id = null)
    {
        //$file = $request->file('img_ppl[]');
//        dd($file);
        $producto = Subtipos::all()->find($id);
        if($request->id_tipo != 0)
            $producto->id_tipo = $request->id_tipo;

        if($request->descripcion != '')
            $producto->descripcion = $request->descripcion;

        //$producto->nombre_img = $file->getClientOriginalName();
        $producto->save();

        return redirect()->route('admin-subtipos');
    }

    public function crear(Request $request)
    {
        $subtipo = new Subtipos();
        $subtipo->id_tipo = $request->id_tipo;
        $subtipo->descripcion = $request->descripcion;
        $subtipo->save();
        return redirect()->route('admin-subtipos');
    }

    public function eliminar($id)
    {
        $subtipo = Subtipos::all()->find($id);
        $productos = Productos::all()->where('id_subtipo', '=', $subtipo->id);
        foreach ($productos as $producto)
            $producto->delete();
        $subtipo->delete();
        return redirect()->route('admin-subtipos');
    }
}
