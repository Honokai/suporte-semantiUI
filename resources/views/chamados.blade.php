@extends('templates.layout')

@section('conteudo')

<div class="ui relaxed divided list">
    @foreach ($chamados as $chamado)
    <div class="item" onclick="abrirModal({{$chamado->id}})" style="cursor: pointer">
        <i class="large github middle aligned icon"></i>
        <div class="content">
            <a class="header">{{$chamado->setor->setor}} - {{$chamado->categoria->categoria}} </a>
            <div class="description">{{$chamado->mensagens[0]->mensagem}}</div>
        </div>
    </div>
    @endforeach
</div>
<div class="ui longer modal" id="modal">
</div>
@endsection