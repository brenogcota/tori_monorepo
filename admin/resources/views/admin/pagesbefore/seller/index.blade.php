@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lojistas <a href="{{route('lojista.create')}}"><button class="btn bg-primary">Adicionar</button></a></h1>
@stop

@section('content')
    @if( $sellers ) 
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th>Imagem</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>CEP</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sellers as $seller) 
                <tr>
                    <td><img style="width: 12vh" src="https://torimarket.com.br/{{$seller->image}}" alt=""></td>
                    <td>{{ $seller->email }}</td>
                    <td>{{ $seller->company_name }}</td>
                    <td>{{ $seller->zip_code }}</td>
                    <td>
                        <a href="{{ route('lojista.show', [$seller->id]) }}"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('lojista.upgrade', [$seller->id]) }}"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('lojista.delete', [$seller->id]) }}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            {{ $sellers->links() }}
        </div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



  


