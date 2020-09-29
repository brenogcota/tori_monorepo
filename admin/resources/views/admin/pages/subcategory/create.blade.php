@extends('admin.template.layout')


@section('content_header')
    <span>Adicionar sub categoria</span>
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
 
        <form action="{{ route('subcategoria.store') }}" method="post" enctype="multipart/form-data">
            @csrf         
                <label for="inputName">Nome</label>
                <div>
                    <input type="text" name="name" id="inputName" class="form-control">
                </div>

                <label>Categoria</label>
                <div>
                    <select name="category_id">
                        @if ($categories)
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div> 
            
            <button class="btn bg-dark-blue" type="submit">Enviar</button>
        </form>
    </div>

    <script src="{{ asset('js/getImage.js') }}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



  


