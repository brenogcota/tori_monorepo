@extends('admin.template.layout')

@section('content_header')
    <span>Atualizar sub categoria</span>
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
        <form action="{{ route('subcategoria.update', [$subcategory->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
                

                <label for="inputName">Nome</label>
                <div>
                    <input type="text" value="{{$subcategory->name}}" name="name" id="inputName" class="form-control">
                </div>

                <label>Categoria</label>
                <div>
                    <select name="category_id">
                        @if ($categories)
                            @foreach ($categories as $category)
                                <option value="{{$category->category_id}}">{{ $category->category_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            
            
            <button class="btn bg-dark-blue" type="submit">Enviar</button>
        </form>
    </div>

    <script  src="{{ asset('js/getImage.js') }}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



  


