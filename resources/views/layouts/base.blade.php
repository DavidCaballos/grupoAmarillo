<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('app.index') }}">GrupoAmarillo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('app.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop.index') }}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shopping.cart') }}">Cart</a>
                    </li>
                </ul>
            </div>
            <div class="onhover-div profile-dropdown">
                <ul>
                    @if(Route::has('login'))
                        @auth
                            @if(Auth::user()->usertype === 'admin')
                                <li>
                                    <a href="{{route('admin.index')}}" class="d-block">Dashboard</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{route('user.index')}}" class="d-block">My Account</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('frmlogout').submit()" class="d-block">Logout</a>
                                <form id="frmlogout" action="{{route('logout')}}" method="POST">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li>
                                <a href="{{route('login')}}" class="d-block">Login</a>
                            </li>
                            <li>
                                <a href="{{route('register')}}" class="d-block">Register</a>
                            </li>   
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="product1.jpg" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title">Product 1</h5>
                        <p class="card-text">Description of Product 1.</p>
                        <p class="card-text"><strong>Price: </strong> $10</p>
                        <a href="{{ route('addProduct.to.cart', 1) }}" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="product2.jpg" class="card-img-top" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title">Product 2</h5>
                        <p class="card-text">Description of Product 2.</p>
                        <p class="card-text"><strong>Price: </strong> $20</p>
                        <a href="{{ route('addProduct.to.cart', 2) }}" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="product3.jpg" class="card-img-top" alt="Product 3">
                    <div class="card-body">
                        <h5 class="card-title">Product 3</h5>
                        <p class="card-text">Description of Product 3.</p>
                        <p class="card-text"><strong>Price: </strong> $30</p>
                        <a href="{{ route('addProduct.to.cart', 3) }}" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
