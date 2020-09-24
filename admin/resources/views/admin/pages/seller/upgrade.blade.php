@extends('admin.template.layout')

@section('content_header')
    <span>Atualizar lojistas</span>
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
        <form action="{{ route('lojista.update', [$seller->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            
            <label for="inputImage" class="upload-image bg-light-blue">
                    <span id="image">Selecione a imagem</span>
                </label>
                <div>
                    <input type="file" value="{{ $seller->image }}" onchange="getImage()" name="image" id="inputImage" class="input-image">
                </div>
                <div id="image">
                </div>

                <label>Email</label>
                <div>
                    <input type="email" value="{{ $seller->email }}" name="email">
                </div>

                <label>Nome da empresa</label>
                <div>
                    <input type="text" value="{{ $seller->company_name }}" name="company_name">
                </div>

                <label>CNPJ</label>
                <div>
                    <input type="text" value="{{ $seller->cnpj }}" name="cnpj">
                </div>

                <label>Banco</label>
                <div>
                    <input type="text" value="{{ $seller->bank }}" name="bank">
                </div>

                <label>Agência</label>
                <div>
                    <input type="text" value="{{ $seller->agency }}" name="agency">
                </div>

                <label>Conta</label>
                <div>
                    <input type="text" value="{{ $seller->account }}" name="account">
                </div>

                <label>CEP</label>
                <div>
                    <input type="text" value="{{ $seller->zip_code }}" name="zip_code">
                </div>

                <label>Permisão</label>
                <div>
                    <select name="roles">
                        <option value="adm">Administrador</option>
                        <option value="seller">Lojista</option>
                        <option value="user">Operador</option>
                    </select>
                </div>   

            <button class="btn bg-light-blue" type="submit">enviar</button>
        </form>
    </div>

    <script src="{{ asset('js/getImage.js') }}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



  


