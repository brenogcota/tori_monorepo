@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    @if( $seller ) 
        <h1>{{ $seller->company_name }}</h1>
    @endif
@stop

@section('content')
    @if( $seller ) 
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th>Imagem</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>CEP</th>
                    <th>CNPJ</th>
                    <th>Banco</th>
                    <th>Agência</th>
                    <th>Conta</th>
                    <th>Permissão</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><img style="width: 12vh" src="https://torimarket.com.br/{{$seller->image}}" alt=""></td>
                    <td>{{ $seller->email }}</td>
                    <td>{{ $seller->company_name }}</td>
                    <td>{{ $seller->zip_code }}</td>
                    <td>{{ $seller->cnpj }}</td>
                    <td>{{ $seller->bank }}</td>
                    <td>{{ $seller->agency }}</td>
                    <td>{{ $seller->account }}</td>
                    <td>{{ $seller->roles }}</td>
                    <td>
                        <a href="{{ route('lojista.upgrade', [$seller->id]) }}"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('lojista.delete', [$seller->id]) }}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



  


