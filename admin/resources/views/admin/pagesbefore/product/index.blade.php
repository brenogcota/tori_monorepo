@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Produtos <a href="{{route('produto.create')}}"><button class="btn bg-primary">Adicionar</button></a></h1>
@stop

@section('content')
    @if( $products ) 
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th>Imagem</th>
                    <th>Produto</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Categoria</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product) 
                <tr>
                    <td><img style="width: 12vh" src="https://torimarket.com.br/{{$product->image}}" alt=""></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category_name }}</td>
                    <td>
                        <a href="{{ route('produto.upgrade', [$product->id]) }}"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('produto.delete', [$product->id]) }}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            {{ $products->links() }}
        </div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



  


