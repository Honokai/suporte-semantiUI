@extends('templates.layout', ["titulo"=> "Suporte - Chamados", "navbar" => true])

@section('conteudo')

<div class="ui relaxed divided list">
    @foreach ($chamados as $chamado)
    <div class="item" onclick="abrirModal({{$chamado->id}})"
        style="cursor: pointer; padding: 10px; background-color:
        @if($chamado->status == 'aberto')rgba(50,160,70, 0.5)@elseif($chamado->status == 'encerrado')rgba(150,10,30, 0.5)@endif"
    >
        <i class="large github middle aligned icon"></i>
        <div class="content">
            <a class="header">{{$chamado->setor->nome}} - {{$chamado->categoria->categoria}} ({{$chamado->status}})
                @if($chamado->ultimaMensagem[0]->remetente_id != Auth::user()->id &&
                    ($chamado->categoria->setor->id == Auth::user()->setor_id || $chamado->solicitante_id == Auth::user()->id) &&
                    $chamado->status != 'aberto')
                    <b style="color: black; background-color: yellow; padding: 2px 10px; border-radius: 5px">Nova mensagem</b>
                @endif
            </a>
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
