<html>
<head>
    @include('components.head')
</head>
<body class="mb-2 bg-body-secondary ">
    <nav class="navbar navbar-expand-md mb-4 bg-info">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">AppRecipe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    @admin
                    <li class="nav-item">
                        <a href="{{ url('recipes') }}" class="nav-link" aria-current="page">Recipes</a>
                    </li>
                    <li class="nav-item">
                    </li> 
                    <li>
                        <a href="{{url('category')}}" class="nav-link" aria-current="page">Categories</a>
                    </li>
                    <li>
                        <a href="{{url('ingredient')}}" class="nav-link" aria-current="page">Ingredients</a>
                    </li>
                    @endadmin
                    @guest
                    <li class="nav-item">
                        <a href="{{ url('guest/recipes') }}" class="nav-link" aria-current="page">All recipes</a>
                    </li>
                    @endguest
                    @customer
                    <li class="nav-item">
                        <a href="{{ url('guest/recipes') }}" class="nav-link" aria-current="page">All recipes</a>
                    </li>
                    @endcustomer
                </ul>
                <ul class="navbar-nav">
                    @auth
                    <a href="{{ route('logout') }}" class="nav-link" aria-current="page">Logout</a>
                    @endauth
                    @guest
                    <a href="{{ route('registration')}}" class="nav-link" aria-current="page">Register</a>
                    <a href="{{ route('login') }}" class="nav-link" aria-current="page">Login</a>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <footer class="container text-center">
        <div>
            &copy 2023 Recipe App
        </div>
        <div>
            Projektą sukūrė: Arnoldas G
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>