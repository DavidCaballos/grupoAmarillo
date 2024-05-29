<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Auth::user();

        // Asegúrate de que solo los usuarios con el tipo "admin" puedan acceder
        if ($admin->usertype !== 'admin') {
            return redirect()->route('user.index');
        }

        return view('admin.index', compact('admin'));
    }
}
