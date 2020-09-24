@extends('admin.template.layout')

@section('content_header')
    <span>Produtos <a href="{{route('produto.create')}}"><button class="btn bg-light-green btn-plus" style="left: 230px;"><img src="{{ asset('assets/icons/plus.svg') }}" alt=""></button></a></span>
@stop

@section('content')
    @if(!sizeof($products))
        <div class="bg-default">
            <p>Nenhum produto encontrado</p>
        </div>
    @endif
    @if( sizeof($products) ) 
        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Produto</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Categoria</th>
                    <th>Ativo</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product) 
                <tr>
                    <td><img class="image-index" src="https://torimarket.com.br{{$product->image}}" alt=""></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category_name }}</td>
                    <td>{{ $product->active }}</td>
                    <td>
                        <a href="{{ route('produto.upgrade', [$product->id]) }}"><img src="{{ asset('assets/icons/edit.svg') }}" alt=""></a>
                        <a href="{{ route('produto.delete', [$product->id]) }}"><img src="{{ asset('assets/icons/group66.svg') }}" alt=""></a>
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



  


