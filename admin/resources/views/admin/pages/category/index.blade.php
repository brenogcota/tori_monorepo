@extends('admin.template.layout')

@section('content_header')
    <span>Categorias <a href="{{route('categoria.create')}}"><button class="btn bg-purple btn-plus" style="left: 215px;"><img src="{{ asset('assets/icons/plus.svg') }}" alt=""></button></a></span>
@stop

@section('content')
    @if(!sizeof($categories))
        <div class="bg-default">
            <p>Nenhuma categoria encontrada</p>
        </div>
    @endif
    @if( sizeof($categories) ) 
        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Loja</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category) 
                <tr>
                    <td><img class="image-index" src="https://torimarket.com.br{{$category->image}}" alt=""></td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->seller_name }}</td>
                    <td>
                        <a href="{{ route('categoria.upgrade', [$category->id]) }}"><img src="{{ asset('assets/icons/edit.svg') }}" alt=""></a>
                        <a href="{{ route('categoria.delete', [$category->id]) }}"><img src="{{ asset('assets/icons/group66.svg') }}" alt=""></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            {{ $categories->links() }}
        </div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



  


