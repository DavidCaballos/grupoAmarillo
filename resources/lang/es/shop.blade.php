@include('navbar')

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/71b7145720.js" crossorigin="anonymous"></script>
</head>

<style>
body {
    background-color: #FFC107; 
}
</style>
<body>

<div class="container mt-5">
    <h2 class="mb-3">Products</h2>

    <div class="row">
        @if($products->count())
            @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('assets/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Price: </strong> ${{ $product->price }}</p>
                        <button class="btn btn-primary add-to-cart" data-id="{{ $product->id }}">Add to Cart</button>
                        <button class="btn btn-secondary add-to-favorites" data-id="{{ $product->id }}">Add to Favorites</button>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12">
                <p>No products available</p>
            </div>
        @endif
    </div>

    <div class="col-12 mt-4">
        <a class="btn btn-outline-dark" href="{{ route('shopping.cart') }}">
            <i class="fas fa-shopping-cart"></i> View Cart <span class="badge bg-danger" id="cart-count">{{ count((array) session('cart')) }}</span>
        </a>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".add-to-cart").click(function (e) {
            e.preventDefault();
            var productId = $(this).data("id");

            $.ajax({
                url: '{{ route('addProduct.to.cart') }}',
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: productId
                },
                success: function (response) {
                    $("#cart-count").text(response.cartCount);
                    alert('Product added to cart successfully!');
                },
                error: function(response) {
                    alert('Failed to add product to cart!');
                }
            });
        });

        $(".add-to-favorites").click(function (e) {
        e.preventDefault();
        var productId = $(this).data("id");

        $.ajax({
            url: '{{ route('addProduct.to.favorites') }}',
            method: "post",
            data: {
                _token: '{{ csrf_token() }}',
                id: productId
            },
            success: function (response) {
                if (response.success) {
                    alert('Product added to favorites successfully!');
                } else {
                    alert(response.message);
                }
            },
            error: function(response) {
                alert('Failed to add product to favorites!');
            }
        });
    });
});
</script>

</body>
</html>
