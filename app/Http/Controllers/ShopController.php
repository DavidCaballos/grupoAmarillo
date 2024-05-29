<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('shop', compact('products'));
    }

    public function cart()
    {
        return view('cart');
    }

    public function addToCart(Request $request)
{
    $product = Product::find($request->id);
    
    if (!$product) {
        return response()->json(['success' => false, 'message' => 'Product not found'], 404);
    }
    
    $cart = session()->get('cart', []);
    
    if (isset($cart[$request->id])) {
        $cart[$request->id]['quantity']++;
    } else {
        $cart[$request->id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
        ];
    }
    
    session()->put('cart', $cart);
    
    $totalItems = array_sum(array_column($cart, 'quantity'));

    return response()->json(['success' => true, 'cartCount' => $totalItems]);
}

    public function removeFromCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            
            if(isset($cart[$request->id])) {
                if($cart[$request->id]['quantity'] > 1) {
                    $cart[$request->id]['quantity']--;
                } else {
                    unset($cart[$request->id]);
                }
                session()->put('cart', $cart);
            }
            
            session()->flash('success', 'Product removed successfully');
        }
        
        return response()->json(['success' => true]);
    }

    public function addToFavorites(Request $request)
    {
        Log::info('Request received: ', $request->all());

        if (!Auth::check()) {
            Log::error('User not authenticated');
            return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
        }

        $product = Product::find($request->id);

        if (!$product) {
            Log::error('Product not found with ID: ' . $request->id);
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        try {
            $favorite = Favorite::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ]);

            Log::info('Favorite added: ', $favorite->toArray());

            return response()->json(['success' => true, 'message' => 'Product added to favorites']);
        } catch (\Exception $e) {
            Log::error('Failed to add favorite: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to add product to favorite']);
        }
    }

    public function removeFromFavorites(Request $request)
    {
        $favorite = Favorite::where('user_id', Auth::id())->where('product_id', $request->id)->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['success' => true, 'message' => 'Product removed from favorites']);
        }

        return response()->json(['success' => false, 'message' => 'Product not found in favorites'], 404);
    }

}
