<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }
  
    public function productCart()
    {
        $cartProducts = session()->get('cart', []);

        $products = Product::whereIn('id', array_keys($cartProducts))->get();

        return view('cart', compact('products'));
    }

    public function addProducttoCart($id)
    {
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
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully.');
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
            session()->flash('success', 'Product successfully removed from cart.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'categories' => 'required|array'
        ]);

        $product = Product::create($request->only('name', 'description', 'price'));
        $product->categories()->sync($request->categories);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => '

    required',
            'description' => 'required',
            'price' => 'required|numeric',
            'categories' => 'required|array'
        ]);

        $product->update($request->only('name', 'description', 'price'));
        $product->categories()->sync($request->categories);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

}
