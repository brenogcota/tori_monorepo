@extends('admin.template.layout')

@section('content_header')
    <span>Sub Categorias <a href="{{route('subcategoria.create')}}"><button class="btn bg-dark-blue btn-plus" style="left: 215px;"><img src="{{ asset('assets/icons/plus.svg') }}" alt=""></button></a></span>
@stop

@section('content')
    @if(!sizeof($subcategories))
        <div class="bg-default">
            <p>Nenhuma sub categoria encontrada</p>
        </div>
    @endif
    @if( sizeof($subcategories) ) 
        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <th>Nome sub categoria</th>
                    <th>Nome categoria</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subcategories as $subcategory) 
                <tr>
                    <td>{{ $subcategory->name }}</td>
                    <td>{{ $subcategory->category_name }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



  


