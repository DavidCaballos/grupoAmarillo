@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mi Cuenta</h2>

    <div class="card mb-4">
        <div class="card-header">
            <h4>Información del Usuario</h4>
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Tipo de Usuario:</strong> {{ $user->usertype }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Pedidos Activos</h4>
        </div>
        <div class="card-body">
            @if($pedidos->isEmpty())
                <p>No tienes pedidos activos.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID del Pedido</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->created_at }}</td>
                            <td>${{ number_format($pedido->total, 2) }}</td>
                            <td>
                                <a href="{{ route('pedido', $pedido->id) }}" class="btn btn-primary">Ver Pedido</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
