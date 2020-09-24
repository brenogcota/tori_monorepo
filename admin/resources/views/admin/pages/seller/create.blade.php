@extends('admin.template.layout')

@section('content_header')
    <span>Adicionar lojista</span>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif

    @if(\Session::has('message'))
        <div class="alert alert-success">
            <div>
                    <p>{!! \Session::get('message') !!}</p>
            </div>
        </div>
    @endif
   

    <div class="form">
        <form action="{{ route('lojista.store') }}" method="post" enctype="multipart/form-data">
            @csrf
        
                <label for="inputImage" class="upload-image bg-light-blue">
                    <span id="image">Selecione a imagem</span>
                </label>
                <div>
                    <input type="file" onchange="getImage()" name="image" id="inputImage" class="input-image">
                </div>
                <div id="image">
                </div>

                <label>Email</label>
                <div>
                    <input type="email" name="email">
                </div>

                <label>Senha</label>
                <div>
                    <input type="password" name="password">
                </div>

                <label>Confirmar senha</label>
                <div>
                    <input type="password" name="password_confirmation">
                </div>

                <label>Nome da empresa</label>
                <div>
                    <input type="text" name="company_name">
                </div>

                <label>CNPJ</label>
                <div>
                    <input type="text" name="cnpj">
                </div>

                <label>Banco</label>
                <div>
                    <input type="text" name="bank">
                </div>

                <label>Agência</label>
                <div>
                    <input type="text" name="agency">
                </div>

                <label>Conta</label>
                <div>
                    <input type="text" name="account">
                </div>

                <label>CEP</label>
                <div>
                    <input type="text" name="zip_code">
                </div>

                <label>Permisão</label>
                <div>
                    <select name="roles" id="">
                        <option value="seller">Lojista</option>
                        <option value="user">Operador</option>
                        <option value="adm">Administrador</option>
                    </select>
                </div>
   


            <button class="btn bg-light-blue" type="submit">Enviar</button>
        </form>
    </div>

    <script src="{{ asset('js/getImage.js') }}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



  


