@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalles del Pedido</h2>

    <div class="card mb-4">
        <div class="card-header">
            <h4>Información del Pedido</h4>
        </div>
        <div class="card-body">
            <p><strong>ID del Pedido:</strong> {{ $pedido->id }}</p>
            <p><strong>Fecha:</strong> {{ $pedido->created_at }}</p>
            <p><strong>Total:</strong> ${{ $pedido->total }}</p>
            <p><strong>Estado:</strong> {{ $pedido->status }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Productos del Pedido</h4>
        </div>
        <div class="card-body">
            @if($productos->isEmpty())
                <p>No hay productos en este pedido.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID del Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td>{{ $producto->id}}</td>
                                <td>${{ $producto->price}}</td>
                                <td>{{ $producto->quantity}}</td>
                                <td>${{ $producto->price * $producto->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
