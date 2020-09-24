@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Categorias <a href="{{route('categoria.create')}}"><button class="btn bg-primary">Adicionar</button></a></h1>
@stop

@section('content')
    @if( $categories ) 
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
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
                    <td><img style="width: 12vh" src="https://torimarket.com.br/{{$category->image}}" alt=""></td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->seller_name }}</td>
                    <td>
                        <a href="{{ route('categoria.show', [$category->id]) }}"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('categoria.upgrade', [$category->id]) }}"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('categoria.delete', [$category->id]) }}"><i class="fa fa-trash"></i></a>
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



  


