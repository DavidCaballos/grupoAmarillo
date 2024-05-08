<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #343a40;">
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
                                <a href="{{route('admin.index')}}" class="d-block text-white">Dashboard</a>
                            </li>
                        @else
                            <li>
                                <a href="{{route('user.index')}}" class="d-block text-white">My Account</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('frmlogout').submit()" class="d-block text-white">Logout</a>
                            <form id="frmlogout" action="{{route('logout')}}" method="POST">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li>
                            <a href="{{route('login')}}" class="d-block text-white">Login</a>
                        </li>
                        <li>
                            <a href="{{route('register')}}" class="d-block text-white">Register</a>
                        </li>   
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
