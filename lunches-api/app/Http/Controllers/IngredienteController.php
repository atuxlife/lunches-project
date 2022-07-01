<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Ingrediente;

class IngredienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredientes = Ingrediente::select('id as Id', 'nombre as Ingredient', 'stock as Stock')
                        ->get();
        return response()->json($ingredientes,201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'    => 'required|string',
            'stock'     => 'required|integer|min:1',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        try {

            $ingrediente = Ingrediente::create($validator->validate());

            return response()->json([
                'message' => '¡Ingrediente creado exitosamente!',
                'ingrediente' => $ingrediente
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => '¡Ingrediente ya existe!'
            ], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $ingrediente = Ingrediente::find($request->id);
        return response()->json($ingrediente,201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $ingrediente = Ingrediente::findOrFail($request->id);
        $ingrediente->nombre = $request->nombre;
        $ingrediente->stock = $request->stock;

        $ingrediente->save();

        return response()->json([
            'message' => '¡Ingrediente modificado exitosamente!',
            'ingrediente' => $ingrediente
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if( !Ingrediente::find($request->id) ){
            return response()->json([
                'message' => '¡Ingrediente no existe!'
            ], 400);
        }

        $ingrediente = Ingrediente::destroy($request->id);

        return response()->json([
            'message' => '¡Ingrediente eliminado exitosamente!',
            'ingrediente' => $ingrediente
        ], 201);
    }
}
