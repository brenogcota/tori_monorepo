@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Categorias</h1>
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
   

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Adicionar categoria</h3>
        </div>
        <form class="form" action="{{ route('categoria.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            
            <div class="card-body">
            
                <label for="inputImage" class="col-sm-2 col-form-label d-block">
                    <span>Selecione a imagem</span>
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-camera-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                        <path fill-rule="evenodd" d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                    </svg>
                </label>
                <div id="image">
                </div>
                <div class="col-sm-10">
                    <input type="file" onchange="getImage()" name="image" id="inputImage" class="d-none">
                </div>

                <label for="inputName" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="inputName" class="form-control">
                </div>
            </div>
            
            <div class="card-footer">
                <button class="btn bg-primary" type="submit">enviar</button>
            </div>
        </form>
    </div>

    <script>
        function getImage(e) {
            var imageName = document.getElementById("inputImage").value;

            imageName = imageName.split("\\")[2];
            var image = document.getElementById("image");

            if(imageName != undefined) {
                image.innerHTML = '<p  class="alert alert-success">'+imageName+'</p>';
            } else {
                image.innerHTML = '<p  class="alert alert-danger">Insira uma imagem válida</p>';
            }
        }
    </script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



  


