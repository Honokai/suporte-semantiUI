@extends('templates.layout', ['titulo' => 'Setores'])
@section('conteudo')
<div class="ui container" style="height: 100%; display:flex; align-items: center; justify-content: center">
    <div class="ui centered grid" style="width: 80%">
        <div style="font-size: 1.3rem; font-weight: bolder">
            Editando: {{$setor->nome}}
        </div>
        <form class="ui form" action="{{route('setores.update', ['setore', $setor->id])}}" style="width: 100%;" method="POST">
            @csrf
            <div class="column" style="margin: 5rem 0">
                <div class="ui labeled fluid input @error('nome') error @enderror" @error('nome') data-content="{{$message}}" @enderror>
                    <div class="ui label">
                    Nome
                    </div>
                    <input name="nome" type="text" value="{{old('nome') ?? $setor->nome ?? ''}}" placeholder="Financeiro">
                </div>
            </div>
            <div class="column" style="margin: 5rem 0">
                <div class="ui labeled fluid input @error('gestor') error @enderror" @error('gestor') data-content="{{$message}}" @enderror>
                    <div class="ui label">
                    Gestor
                    </div>
                    <input name="gestor" type="text" value="{{old('gestor') ?? $setor->gestor ?? ''}}" placeholder="Financeiro">
                </div>
            </div>
            <button class="ui button" type="submit">Enviar</button>
        </form>
    </div>
</div>
@endsection