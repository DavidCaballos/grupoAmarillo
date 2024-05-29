<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedido;
use App\Models\Envio;
use App\Models\ObjetosPedido;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        return view('checkout');
    }

    public function process(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'country' => 'required',
        ]);
    
        // Calcular el total del pedido
        $total = $this->calculateTotal();
        
        // Crear un nuevo pedido con el total calculado y el nombre
        $pedido = Pedido::create([
            'user_id' => 2, // Obtener el ID del usuario autenticado
            'total' => $total,
            'status' => 'ordered', // Asegúrate de que esté entre comillas
            'name' => $request->name, // El valor de name viene del request validado
        ]);
    
        // Crear un nuevo registro de envío asociado al pedido
        Envio::create([
            'order_id' => $pedido->id,
            'name' => $request->name,
            'address' => $request->address,
            'country' => $request->country,
            'status' => 'ready for send', // Asegúrate de que esté entre comillas
        ]);
    
        // Guardar los productos del carrito en la tabla objetos_pedidos
        $cart = session('cart');
        if ($cart) {
            foreach ($cart as $id => $details) {
                // Crear el objeto pedido
                ObjetosPedido::create([
                    'product_id' => $id,
                    'order_id' => $pedido->id,
                    'price' => $details['price'],
                    'quantity' => $details['quantity'],
                ]);

                // Actualizar la cantidad del producto en la base de datos
                $product = Product::find($id);
                if ($product) {
                    $product->quantity -= $details['quantity'];
                    $product->save();
                }
            }
        }

        // Vaciar el carrito de la sesión del usuario
        $request->session()->forget('cart');
        // Redirigir a una página de confirmación
        return view('cart');
    }

    public function showConfirmation()
    {
        return view('cart');
    }

    private function calculateTotal()
    {
        $total = 0;

        // Obtener los productos del carrito de la sesión
        $cart = session('cart');

        // Recorrer los productos y sumar el precio total
        if ($cart) {
            foreach ($cart as $id => $details) {
                $total += $details['price'] * $details['quantity'];
            }
        }

        return $total;
    }
}
