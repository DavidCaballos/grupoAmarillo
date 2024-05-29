@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard de Administrador</h2>

    <div class="card mb-4">
        <div class="card-header">
            <h4>Información del Administrador</h4>
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $admin->name }}</p>
            <p><strong>Email:</strong> {{ $admin->email }}</p>
            <p><strong>Tipo de Usuario:</strong> {{ $admin->usertype }}</p>
        </div>
    </div>
</div>
@endsection
