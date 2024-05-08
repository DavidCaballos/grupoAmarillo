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
        $cartProducts = session()->get('cart', []);

        $products = Product::whereIn('id', array_keys($cartProducts))->get();

        return view('cart', ['products' => $products]);
    }

public function addProducttoCart($id)
{
    if (auth()->check()) {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $cartItemId = $id . '-' . time(); 


        $cart[$cartItemId] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "description" => $product->description
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product has been added to cart');
    } else {

        return redirect()->route('login')->with('error', 'You need to log in to add products to the cart');
    }
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
