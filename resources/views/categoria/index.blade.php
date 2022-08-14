@extends('templates.layout', ['titulo' => "Listar categorias", 'navbar' => true])

@section('head')
<link rel="stylesheet" href="/css/custom.css">
@endsection

@section('conteudo')
<div class="ui container">
    @include('templates.feedback')
    <div class="ui container">
        <button class="ui right floated primary button" style="margin: 0.2rem 0" onclick="abrirModal('{{route('categorias.create')}}')"><i class="icon plus"></i>Categoria</button>
    </div>
    @foreach ($categorias as $categoria)
        @php
            $disabled = $categoria->deleted_at ? " disabled" : "";
        @endphp
        <div class="object-header{{$disabled}}">
            <div style="display:flex; flex:1">
                {{ $categoria->nome }}
            </div>
            <div style="display:flex; flex:1; justify-content:end">
                @if($disabled)
                    <form style="display: inline" action="{{route('categorias.restore', ['categoria'=>$categoria->id])}}" method="POST">
                        @csrf
                        @method('put')
                        <button class="ui inverted icon green button" type="submit"
                            data-tooltip="Reativar categoria." data-position="top center"
                            data-variation="basic"
                        >
                            <i class="icon redo"></i>
                        </button>
                    </form>
                @else
                    <form style="display: inline" action="{{route('categorias.destroy',['categoria'=>$categoria->id])}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="ui inverted icon red button" type="submit" 
                            data-tooltip="Desativar categoria." data-position="top center"
                            data-variation="basic"
                        >
                            <i class="icon trash"></i>
                        </button>
                    </form>
                @endif
                <button onclick="abrirModal('{{route('subcategorias.create', ['categoria' => $categoria->id])}}')" class="ui primary button"><i class="icon plus"></i> Subcategoria</button>
            </div>
        </div>
        @foreach ($categoria->subcategorias as $subcategoria)
        <div @if($subcategoria->deleted_at) class="disabled" @endif style="display: flex; width: 100%; padding: .6rem">
            <div style="flex:1">{{$subcategoria->nome}}</div>
            <div style="display:flex; flex:1; justify-content:end">
                @if($subcategoria->deleted_at)
                    <form style="display: inline" action="{{route('subcategorias.restore',['subcategoria'=>$subcategoria->id])}}" method="POST">
                        @csrf
                        @method('put')
                        <button class="ui inverted icon green button" type="submit"
                            data-tooltip="Reativar subcategoria." data-position="top center"
                            data-variation="basic"
                        >
                        <i class="icon redo"></i></button>
                    </form>
                @else
                    <form style="display: inline" action="{{route('subcategorias.destroy',['subcategoria'=>$subcategoria->id])}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="ui inverted icon red button" type="submit"
                        data-tooltip="Desativar subcategoria." data-position="top center"
                        data-variation="basic"
                        ><i class="icon trash"></i></button>
                    </form>
                @endif
            <button class="ui inverted primary button">Editar</button></div>
        </div>      
        @endforeach
    @endforeach
</div>
@endsection