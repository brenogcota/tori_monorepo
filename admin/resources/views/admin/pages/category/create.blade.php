@extends('admin.template.layout')


@section('content_header')
    <span>Adicionar categoria</span>
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
 
        <form action="{{ route('categoria.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            
                <label for="inputImage" class="upload-image bg-purple">
                    <span id="image">Selecione a imagem</span>
                </label>
                <div>
                    <input type="file" onchange="getImage()" name="image" id="inputImage" class="input-image">
                </div>

                <label for="inputName">Nome</label>
                <div>
                    <input type="text" name="name" id="inputName" class="form-control">
                </div>
            
            <button class="btn bg-purple" type="submit">Enviar</button>
        </form>
    </div>

    <script src="{{ asset('js/getImage.js') }}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



  


