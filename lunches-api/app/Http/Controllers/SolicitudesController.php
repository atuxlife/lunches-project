<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Ingrediente;
use App\Models\MenuIngrediente;
use App\Models\IngredienttList;
use App\Models\OrderList;
use App\Models\PurchaseOrder;

class SolicitudesController extends Controller
{
    // Listado de órdenes solicitadas a la cocina
    public function index()
    {
        $ordenes = $this->listOrders();
        return response()->json($ordenes,201);
    }

    // Pedir plato random a la cocina
    public function solicitarPlato()
    {
        // Solicitar plato random
        $plato = Menu::inRandomOrder()
                 ->select('id', 'nombre')
                 ->limit(1)
                 ->get();

        // Verificar las existencias de ingredientes
        $ingredientes = $this->verificarExistencias($plato[0]['id']);

        $solicitar = 0;
        $ingredientsList = [];
        $mensajeRespuesta = '';
        $estadoOrden = '';
        $platoName = $plato[0]['nombre'];
        $error = 0;

        foreach ($ingredientes as $value) {
            if($value['stock'] == 0){
                $solicitar = 1;
                $this->toPendingList($value['id']); // Creo una entrada en la lista de ingredientes pendientes por comprar
                array_push($ingredientsList, $value['nombre']);
            }
        }

        if( $solicitar == 1 ){
            $mensajeRespuesta = 'No se podrá preparar el plato '.$platoName.' por falta de los ingredientes: '.implode(', ', $ingredientsList).'. Se hará la solicitud de compra.';
            $estadoOrden = 'pending';
            $error = 1;
        } else {
            $mensajeRespuesta = 'Prepararo y entrego el plato '.$platoName.' para el cliente';
            $estadoOrden = 'completed';
            foreach ($ingredientes as $value) {
                $this->stockOutput($value['id']);
            }
        }

        try {
            // Guardo la orden
            $order = OrderList::create([
                'menu_id'   => $plato[0]['id'],
                'status'    => $estadoOrden
            ]);

            return response()->json([
                'message'   => $mensajeRespuesta,
                'error'     => $error,
                'order'     => $order
            ],201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => '¡No se pudo guardar la orden, revise la operación realizada!'
            ], 400);
        }
    }

    // Solicitar compra de ingredientes faltantes en el inventario del restaurante
    public function solicitarCompra()
    {
        // Listar agrupados los ingredientes pendientes
        $ingredientes = IngredienttList::selectRaw('ingrediente_id, sum(qty) as pending_stock')
                        ->where('requested', 'N')
                        ->groupBy('ingrediente_id')
                        ->get();

        $ordenes = [];

        // Crear órdenes de compra por ingredientes faltantes
        foreach ($ingredientes as $value) {
            $orden = PurchaseOrder::create([
                'ingrediente_id'    =>  $value['ingrediente_id'],
                'qty'               =>  (integer)$value['pending_stock'],
                'status'            =>  'requested'
            ]);
            $ingredienteUpdate = IngredienttList::where('ingrediente_id', $value['ingrediente_id'])
                                 ->where('requested', 'N');
            $ingredienteUpdate->update([
                'requested' => 'Y',
            ]);
            array_push($ordenes, $orden);
        }

        return response()->json([
            'message' => 'Compras solicitadas exitosamente',
            'ordenes' => $ordenes
        ],201);
    }

    // Reprocesar órdenes a la cocina
    public function reprocesarOrdenes()
    {
        $ordenes = OrderList::where('status', 'pending')->get();

        foreach ($ordenes as $value) {

            // Verificar las existencias de ingredientes
            $ingredientes = $this->verificarExistencias($value['id']);

            $solicitar = 0;
            $estadoOrden = '';

            foreach ($ingredientes as $valueLista) {
                if($valueLista['stock'] == 0){
                    $solicitar = 1;
                    $this->toPendingList($valueLista['id']); // Creo una entrada en la lista de ingredientes pendientes por comprar
                }
            }

            if( $solicitar == 1 ){
                $estadoOrden = 'pending';
            } else {
                $estadoOrden = 'completed';
                foreach ($ingredientes as $valueStock) {
                    $this->stockOutput($valueStock['id']);
                }
            }

            // Guardo la orden
            $order = OrderList::where('id', $value['id'])
                     ->update(['status' => $estadoOrden]);

        }

        $nuevasOrdenes = $this->listOrders();

        return response()->json([
            'message' => 'Órdenes actualizadas correctamente',
            'ordenes' => $nuevasOrdenes
        ],201);
    }

    // Verificar las existencias de ingredientes
    private function verificarExistencias(Int $plato)
    {
        $ingredientes = MenuIngrediente::join('ingredientes', 'menu_ingredientes.ingrediente_id', '=', 'ingredientes.id')
                            ->select('ingredientes.id', 'ingredientes.nombre', 'ingredientes.stock')
                            ->where('menu_ingredientes.menu_id',$plato)
                            ->get();

        return $ingredientes;
    }

    // Listado de órdenes para la vista
    private function listOrders()
    {
        $ordenes = OrderList::join('menus', 'order_lists.menu_id', '=', 'menus.id')
                   ->select('order_lists.id as Id', 'menus.nombre as Order', 'order_lists.status as Status')
                   ->orderBy('id', 'asc')
                   ->get();

        return $ordenes;
    }

    // Método para guardar ingredientes en la lista de pendientes para comprar
    private function toPendingList(Int $ingredienteFaltante)
    {
        $ingrediente = IngredienttList::create([
            'ingrediente_id' => $ingredienteFaltante,
            'qty' => 1
        ]);

        return $ingrediente;
    }

    // Actualizar el stock de ingredientes cuando se sirve un plato
    private function stockOutput(Int $ingrediente)
    {
        $stockUpdate = Ingrediente::where(['id' => $ingrediente])->decrement('stock', 1);

        return $stockUpdate;
    }
}
