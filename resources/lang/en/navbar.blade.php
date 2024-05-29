<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #343a40;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('app.index') }}">@lang('public.grupoamarillo')</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('app.index') }}">@lang('public.home')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop.index') }}">@lang('public.shop')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shopping.cart') }}">@lang('public.cart')</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @lang('public.language')
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        <li><a class="dropdown-item" href="locale/en">English</a></li>
                        <li><a class="dropdown-item" href="locale/es">Español</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="onhover-div profile-dropdown">
            <ul>
                @if(Route::has('login'))
                    @auth
                        @if(Auth::user()->usertype === 'admin')
                            <li>
                                <a href="{{route('admin.index')}}" class="d-block text-white">@lang('public.dashboard')</a>
                            </li>
                        @else
                            <li>
                                <a href="{{route('user.index')}}" class="d-block text-white">@lang('public.myaccount')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('password.change') }}">@lang('public.pswchange')</a>
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
                            <a href="{{route('login')}}" class="d-block text-white">@lang('public.login')</a>
                        </li>
                        <li>
                            <a href="{{route('register')}}" class="d-block text-white">@lang('public.register')</a>
                        </li>   
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

