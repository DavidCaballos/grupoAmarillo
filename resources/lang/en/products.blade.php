@extends('shop')
@section('content')
    <h2 class="mb-3">Products</h2>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('assets/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Price: </strong> ${{ $product->price }}</p>
                        <a href="{{ route('addProduct.to.cart', $product->id) }}" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-12 mt-4">
        <a class="btn btn-outline-dark" href="{{ route('shopping.cart') }}">
            <i class="fas fa-shopping-cart"></i> View Cart <span class="badge bg-danger">{{ count((array) session('cart')) }}</span>
        </a>
    </div>
@endsection
