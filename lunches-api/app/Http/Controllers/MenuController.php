<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuIngrediente;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return response()->json($menus,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $menu = Menu::find($request->id);

        $ingredientes = MenuIngrediente::join('ingredientes', 'menu_ingredientes.ingrediente_id', '=', 'ingredientes.id')
                        ->select('ingredientes.nombre')
                        ->where('menu_id',$request->id)
                        ->get();

        $return = [
            'menu'          => $menu,
            'ingredientes'  => $ingredientes
        ];

        return response()->json($return,201);
    }
}
