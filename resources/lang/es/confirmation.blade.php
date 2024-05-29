@extends('navbar')

@section('content')
<div class="container mt-5">
    <h2>Confirmación de Pedido</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <p>Tu pedido ha sido realizado con éxito. Gracias por tu compra.</p>
    <a href="{{ route('shop') }}" class="btn btn-primary">Volver a la tienda</a>
</div>
@endsection
