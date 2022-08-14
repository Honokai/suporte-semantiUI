@extends('templates.layout', ['navbar' => true, 'titulo' => 'Setores'])

@section('head')
<link rel="stylesheet" href="/css/custom.css">
@endsection

@section('conteudo')
<div class="ui container">
    @include('templates.feedback')
    <div style="text-align: right; padding: 0.2rem 0">
        <button class="ui primary button" onclick="abrirModal('{{route('setores.create')}}')"><i class="plus icon"></i>Setor</button>
    </div>
    @foreach ($setores as $setor)
        @php
            $disabled = $setor->deleted_at ? " disabled" : "";
        @endphp
        <div class="object-header{{$disabled}}">
            <div style="display:flex; flex:1">
                {{ $setor->nome }}
            </div>
            <div style="display:flex; flex:1; justify-content:end">
                @if($disabled)
                    <form style="display: inline" action="{{route('setores.restore', ['setor'=>$setor->id])}}" method="POST">
                        @csrf
                        @method('put')
                        <button class="ui inverted icon green button" type="submit"
                            data-tooltip="Reativar setor." data-position="top center"
                            data-variation="basic"
                        >
                            <i class="icon redo"></i>
                        </button>
                    </form>
                @else
                    <form style="display: inline" action="{{route('setores.destroy',['setore'=>$setor->id])}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="ui inverted icon red button" type="submit" 
                            data-tooltip="Desativar setor." data-position="top center"
                            data-variation="basic"
                        >
                            <i class="icon trash"></i>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection