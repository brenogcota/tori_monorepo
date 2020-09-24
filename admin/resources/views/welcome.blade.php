@extends('admin.template.layout')

@section('title', 'Dashboard')


@section('content_header')
    <span>Home</span>
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
        <div class="alert alert-danger">
            <div>
                    <p>{!! \Session::get('message') !!}</p>
            </div>
        </div>
    @endif

    <div class="cards">
        @if($users) 
            <div class="card">
                <div class="count">
                    <span>{{ $users }} </span>
                </div>
                <p>Usuários</p>
            </div>
        @endif

        @if(!$users) 
            <div class="card">
                <p>Nenhum usuário encontrado</p>
            </div>
        @endif


        @if($sellers) 
            <div class="card">
                <div class="count">
                    <span>{{ $sellers }} </span>
                </div>
                <p>Lojistas</p>
            </div>
        @endif

        @if(!$sellers) 
            <div class="card">
                <p>Nenhum lojista encontrado</p>
            </div>
        @endif

        @if($products) 
            <div class="card">
                <div class="count">
                    <span>{{ $products }} </span>
                </div>
                <p>Produtos</p>
            </div>
        @endif

        @if(!$products) 
            <div class="card">
                <p>Nenhum produto encontrado</p>
            </div>
        @endif

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



  


