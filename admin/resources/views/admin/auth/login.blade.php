
<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="gb18030">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth-page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">

    <title>Entrar</title>
</head>
<body>

    <main> 
        <section class="bg-form">
            @if (\Session::has('message'))
                <div class="alert alert-danger">
                        <p>{!! \Session::get('message') !!}</p>
                </div>
            @endif
            <div class="auth-form">
                <img src="{{ asset('assets/images/logo.png') }}" alt="">
                <form action="{{ route('auth.signin') }}" method="POST">
                    @csrf
                    <input type="text" name="username" placeholder="Usuario/Email">
                    
                    <input type="password" name="password" placeholder="Senha" id="pass">
                    
                    <a id="myBtn">Esqueceu sua senha?</a>
                    <button type=submit >Entrar</button>
                </form>
            </div>

            <a href="https://woobe.com.br/" target="_blank">Woobe</a>
        </section>
        <section class="bg-img">
        </section>
    </main>

    
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="{{ route('sendforgotpasswordmail') }}" method="POST">
                @csrf
                <label for="email">Informe o email para recuperacao</label>
                <input type="email" name="email">
                <button type="submit">Enviar</button>
            </form>  
        </div>
    </div>

</body>
<script src="{{ asset('js/modal.js') }}"></script>
</html>
    
