<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function show($id)
    {
        $pedido = Pedido::findOrFail($id);
        $productos = $pedido->orderItems; // Recuperar los productos asociados al pedido a través de la relación 'orderItems'
    
        return view('pedido', compact('pedido', 'productos'));
    }
}
