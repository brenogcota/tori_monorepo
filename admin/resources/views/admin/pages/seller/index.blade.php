@extends('admin.template.layout')

@section('content_header')
    <span>Lojistas <a href="{{route('lojista.create')}}"><button class="btn bg-light-blue btn-plus" style="left: 240px;"><img src="{{ asset('assets/icons/plus.svg') }}" alt=""></button></a></span>
@stop

@section('content')

    @if(!sizeof($sellers))
        <div class="bg-default">
            <p>Nenhum lojista encontrado</p>
        </div>
    @endif
    @if( sizeof($sellers) ) 
        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Email</th>
                    <th>Nome da empresa</th>
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
                @foreach($sellers as $seller) 
                <tr>
                    <td><img class="image-index" src="https://torimarket.com.br{{$seller->image}}" alt=""></td>
                    <td>{{ $seller->email }}</td>
                    <td>{{ $seller->company_name }}</td>
                    <td>{{ $seller->zip_code }}</td>
                    <td>{{ $seller->cnpj }}</td>
                    <td>{{ $seller->bank }}</td>
                    <td>{{ $seller->agency }}</td>
                    <td>{{ $seller->account }}</td>
                    <td>{{ $seller->roles }}</td>
                    <td>
                        <a href="{{ route('lojista.upgrade', [$seller->id]) }}"><img src="{{ asset('assets/icons/edit.svg') }}" alt=""></a>
                        <a href="{{ route('lojista.delete', [$seller->id]) }}"><img src="{{ asset('assets/icons/group66.svg') }}" alt=""></a>
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



  


