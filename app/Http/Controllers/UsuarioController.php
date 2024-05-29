<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;

class UsuarioController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Asegúrate de que solo los usuarios con el tipo "user" puedan acceder
        if ($user->usertype !== 'user') {
            return redirect()->route('admin.index');
        }

        $pedidos = Pedido::where('user_id', $user->id)->get();

        return view('user.index', ['user' => $user, 'pedidos' => $pedidos]);
    }
}
