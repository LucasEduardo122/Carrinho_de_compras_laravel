<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.css')}}">
    <title>Carrinho de compras - @yield('titulo_pagina')</title>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container">
                <a class="navbar-brand text-light" href="#">LaravelShop</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-light" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{route('carrinho')}}">Carrinho</a>
                        </li>
                        @if(!Auth::check())
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{route('login.form')}}">Login</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{route('register.form')}}">Registrar</a>
                        </li>
                        @endif
                        @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @php
                                $user = Auth::user();
                                echo $user->name
                                @endphp
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Perfil</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <a class="dropdown-item" href="{{env('APP_URL')}}logout">Sair</a>

                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    @yield('pagina_conteudo')

    <script src="{{asset('site/js/jquery.js')}}"></script>
    <script src="{{asset('site/js/bootstrap.bundle.js')}}"></script>

    <footer>
        <nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-primary">
            <div class="container">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Desenvolvedor: Lucas Eduardo <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                     <a class="nav-link text-white" href="https://github.com/LucasEduardo122">Github: LucasEduardo122</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Carrinho de compras com Laravel <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </footer>
</body>

</html>