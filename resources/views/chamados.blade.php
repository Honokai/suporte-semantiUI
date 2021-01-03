@extends('templates.layout', ["titulo"=> "Suporte - Chamados"])

@section('conteudo')

<div class="ui relaxed divided list">
    @foreach ($chamados as $chamado)
    <div class="item" onclick="abrirModal({{$chamado->id}})" style="cursor: pointer; padding: 10px">
        <i class="large github middle aligned icon"></i>
        <div class="content">
            <a class="header">{{$chamado->setor->setor}} - {{$chamado->categoria->categoria}} ({{$chamado->status}})  </a>
            <div class="description">{{$chamado->mensagens[0]->mensagem}}</div>
        </div>
    </div>
    @endforeach
</div>
<style>
    /* botao fechar do modal dentro do header */
    i.close.icon::before {
        cursor: pointer;
        position: absolute;
        font-size: 25px;
        color: gray;
        left: -30px;
        top: 45px;
    }
    @media(max-width: 600px) {
        i.close.icon::before {
            cursor: pointer;
            position: absolute;
            font-size: 25px;
            color: gray;
            left: -5px;
            top: 5px;
        }
    }
    /* div semi transparente para modal adicionada ao abrir o modal*/
    .ui.dimmer {
        padding: 0 !important;
    }
    /* retirada margem para que o modal fique contido dentro da tela 1366 por 720*/
    .modals.dimmer .ui.scrolling.modal {
        margin: 0.5rem auto;
    }
</style>
<div class="ui longer modal" id="modal">
</div>
@endsection