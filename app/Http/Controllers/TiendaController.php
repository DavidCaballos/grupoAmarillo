<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function index(){
        $products = Product::orderBy('created_at', 'ASC')->paginate(12);
        return view('shop',['products'=>$products]);
    }
}
