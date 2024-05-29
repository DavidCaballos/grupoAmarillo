@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($product) ? 'Edit' : 'Create' }} Product</h1>
    <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="POST">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" required>{{ $product->description ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="categories">Categories:</label>
            <select multiple class="form-control" id="categories" name="categories[]">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ isset($product) && $product->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
@endsection
