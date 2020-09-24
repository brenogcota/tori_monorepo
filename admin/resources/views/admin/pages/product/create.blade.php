@extends('admin.template.layout')

@section('content_header')
    <span> Acionar produto</span>
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
        <form action="{{ route('produto.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            
                <label for="inputImage" class="upload-image bg-light-green">
                    <span id="image">Selecione a imagem</span>
                </label>
                <div>
                    <input type="file" onchange="getImage()" name="image" id="inputImage" class="input-image">
                </div>

                <label>Nome</label>
                <div>
                    <input type="text" name="name">
                </div>

                <label>Descriçao</label>
                <div>
                    <input type="text" name="description">
                </div>

                <label>Preço</label>
                <div>
                    <input type="text" name="price">
                </div>

                <label>Estoque</label>
                <div>
                    <input type="text" name="stock">
                </div>

                <label>Ativo</label>
                <div>
                    <select name="active">
                        <option value="sim">Sim</option>
                        <option value="nao">Não</option>
                    </select>
                </div>

                <label>Categoria</label>
                <div>
                    <select name="category_name">
                        @if ($categories)
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>  

            <button class="btn bg-light-green" type="submit">Enviar</button>

        </form>
    </div>

    <script src="{{ asset('js/getImage.js') }}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



  


