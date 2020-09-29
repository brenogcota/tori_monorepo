<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">

    <title>ToriMarket</title>
</head>
<body>
    <main>
        <div class="header">
            <div class="menu-hamburger">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </div>
        </div>
        <div class="menu">
            <div id="logo"><img src="{{ asset('assets/images/logo.png') }}" alt="">
            </div>
            <a href="{{ route('home')}}"><div class="bg bg-light-purple"><img src="{{ asset('assets/icons/homewhite.svg') }}" alt=""></div> <small>Home</small></a>
            <a href="{{ route('lojista.index')}}"><div class="bg bg-light-blue"><img src="{{ asset('assets/icons/group65.svg') }}" alt=""></div> <small>Lojistas</small></a>
            <a href="{{ route('categoria.index')}}"><div class="bg bg-purple"><img src="{{ asset('assets/icons/group68.svg') }}" alt=""></div> <small>Categorias</small></a>
            <a href="{{ route('subcategoria.index')}}"><div class="bg bg-dark-blue"><img src="{{ asset('assets/icons/group68.svg') }}" alt=""></div> <small>Sub Categorias</small></a>
            <a href="{{ route('produto.index')}}"><div class="bg bg-light-green"><img src="{{ asset('assets/icons/group69.svg') }}" alt=""></div> <small>Produtos</small></a>
            <a href="{{ route('usuario.index')}}"><div class="bg bg-light-orange"><img src="{{ asset('assets/icons/group65.svg') }}" alt=""></div> <small>Usuarios</small></a>
            <a><div class="bg bg-light-red" id="myBtn" class="logout"><img src="{{ asset('assets/icons/group64.svg') }}" alt=""></div> <small>Sair</small></a>
        </div>
        <section class="content">
            <h1> <strong>Painel</strong> de controle</h1>
            @yield('content_header')

            @yield('content')
        </section>

    </main>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <form action="{{ route('logout') }}" method="GET">
                @csrf
                <label>Deseja realmente sair?</label>
                <div>
                    <button type="submit">Sim</button>
                    <span class="close">Não</span>
                </div>
            </form>  
        </div>
    </div>
</body>
<script src="{{ asset('js/modal.js') }}"></script>
<script src="{{ asset('js/menu.js') }}"></script>
</html>