<?php

namespace App\Http\Controllers;

use App\Models\MarketPlace;
use App\Models\PurchaseOrder;
use App\Models\Ingrediente;

class MarketPlaceController extends Controller
{
    // Listado de todo el inventario
    public function index()
    {
        $ingredientes = MarketPlace::select('id as Id', 'nombre as Ingredient', 'stock as Stock')
                        ->get();
        return response()->json($ingredientes,201);
    }

    // Solicitud de compras al mercado
    public function comprarMercado()
    {
        $ordenes = PurchaseOrder::where('status', 'requested')
                   ->orWhere('status', 'pending')
                   ->get();
        $estadoOrden = '';

        foreach ($ordenes as $value) {
            $ingrediente = MarketPlace::find($value['ingrediente_id']);
            if( $ingrediente['stock'] >= $value['qty'] ){
                // Bajo del inventario del mercado la cantitdad solicitada por la orden de compra
                $this->marketStockOutput($value['ingrediente_id'], (integer)$value['qty']);
                // Incremento el stock de un ingrediente en el restaurante
                $this->restaurantStockInput($value['ingrediente_id'], (integer)$value['qty']);
                $estadoOrden = 'completed';
            } else {
                $estadoOrden = 'pending';
            }
            // Actualizar la orden
            $orden = PurchaseOrder::where('id', $value['id'])
                     ->update(['status' => $estadoOrden]);
        }

        $nuevasOrdenes = PurchaseOrder::all();

        return response()->json([
            'message' => 'Órdenes de compra procesadas',
            'ordenes' => $nuevasOrdenes
        ],201);
    }

    // Actualizar el stock del mercado cuando se está acabando
    public function actualizarMercado()
    {
        $ingredientes = MarketPlace::all();

        foreach ($ingredientes as $value) {
            $stockUpdate = MarketPlace::where(['id' => $value['id']])->increment('stock', 10);
        }

        $nuevoStock = MarketPlace::all();

        return response()->json([
            'message' => 'Stock actualizado',
            'mercado' => $nuevoStock
        ],201);
    }

    // Listar órdenes de compra para la vista
    public function ordenesCompra(){
        $ordenes = PurchaseOrder::join('ingredientes', 'purchase_orders.ingrediente_id', '=', 'ingredientes.id')
                   ->select('purchase_orders.id as Id', 'ingredientes.nombre as Ingredient', 'purchase_orders.qty as Qty', 'purchase_orders.status as Status')
                   ->get();

        return response()->json($ordenes,201);
    }

    // Actualizar el stock de mercado cuando se compra
    private function marketStockOutput(Int $ingrediente, Int $cantidad)
    {
        $stockUpdate = MarketPlace::where(['id' => $ingrediente])->decrement('stock', $cantidad);

        return $stockUpdate;
    }

    // Actualizar el stock del restaurante cuando se compra
    private function restaurantStockInput(Int $ingrediente, Int $cantidad)
    {
        $stockUpdate = Ingrediente::where(['id' => $ingrediente])->increment('stock', $cantidad);

        return $stockUpdate;
    }
}
