@extends('admin.template.layout')

@section('content_header')
    <span>Usuários</span>
@stop

@section('content')
    @if(!sizeof($users))
        <div class="bg-default">
            <p>Nenhum usuário encontrado</p>
        </div>
    @endif
    @if( sizeof($users) ) 
        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user) 
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>

            {{ $users->links() }}
        </div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



  


