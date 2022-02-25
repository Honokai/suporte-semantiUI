@extends('templates.layout', ['titulo' => "Criar categoria", 'navbar' => true])
@section('conteudo')
    <form action="{{route('categorias.store')}}" method="POST">
        @csrf
        <input type="text">
        <input type="text">
        <button></button>
    </form>
@endsection
