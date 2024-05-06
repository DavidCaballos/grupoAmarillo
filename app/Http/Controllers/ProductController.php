<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products', ['products' => $products]);
    }
  
    public function productCart()
    {
        // Obtener los productos del carrito de la sesión, si existen
        $cartProducts = session()->get('cart', []);

        // Puedes obtener los detalles completos de los productos desde tu base de datos
        // Por ejemplo, si tienes un modelo llamado Product:
        $products = Product::whereIn('id', array_keys($cartProducts))->get();

        return view('cart', ['products' => $products]);
    }

    public function addProducttoCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // Genera un identificador único para cada producto en el carrito
        $cartItemId = $id . '-' . time(); // Puedes usar una marca de tiempo como identificador único

        // Agrega un nuevo elemento al carrito
        $cart[$cartItemId] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "description" => $product->description
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product has been added to cart');
    }

    
    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Product added to cart.');
        }
    }

    public function deleteProduct(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully deleted.');
        }
    }
}
