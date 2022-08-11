@extends('templates.layout')
@section('conteudo')
@php
    switch ($chamado->status) {
        case 'aberto':
            $cor="rgb(237, 89, 78)";
            break;
        case 'em andamento':
            $cor="rgb(242, 236, 68)";
            break;
        case 'finalizado':
            $cor="rgb(78, 118, 150)";
            break;
        case 'concluído':
            $cor="rgb(78, 118, 150)";
            break;
        case 'reaberto':
            $cor="rgb(78, 118, 150)";
            break;
    }
@endphp
<style>
    .chamado-card {
        flex: 1;
        background: #6f7074;
        margin: 10px 0 10px 5px;
        border-radius: 4px;
        color: rgb(255, 255, 255);
        padding: 1rem 0.8rem;
    }

    .actions {
        padding: .5rem 0;
    }
    .chamado-card > .header {
        flex: 1;
        font-size: 1.5rem;
    }

    .chamado-info {
        flex: 1;
    }

    .chamado-card .chamado-info .campos-item {
        margin: 5px 0;
        font-size: 1.15rem;
    }

    .campos-item div > a {
        color: rgb(168, 168, 255);
        font-weight: bolder;
    }

    .campos-item div > a:hover {
        filter: brightness(0.9);
    }

    .chamado-card .chamado-info .campos-item > b+div {
        font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
        border: 0;
        line-height: 1.31428571em;
        color: rgb(255, 255, 255);
        max-height: 38px !important;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    .scrolling {
        overflow: hidden;
        overflow-y: auto;
    }
    
    .print {
        margin: 0.8rem 0;
        font-size: 1.5rem;
    }

    @media print {
        .scrolling {
            overflow: unset;
            /* overflow-y: unset; */
            margin: 1rem 0;
        }
        .ui.form {
            display: none;
        }
    }

    .d-none {
        display: none !important;
    }
</style>
@if(session('suporte'))
    <script>
        window.parent.location.href = "{{route('chamado.index', ['nomeSetor' => session('suporte')])}}"
    </script>
@endif
<div class="ui fluid container" style="margin: 0 !important; height: 100%; display:flex">
    <div class="chamado-card">
        <div class="header">
            Chamado #{{ $chamado->id }}
        </div>
        <div class="print">
            <button onclick="parent.printIframe()"><i class="print icon"></i></button>
        </div>
        <div class="chamado-info">
            <div class="campos-item">
                <b>Status</b>
                <div class="date">
                    {{Illuminate\Support\Str::title($chamado->status)}}
                </div>
            </div>
            <div class="campos-item">
                <b>Data abertura</b>
                <div class="date">
                    {{ Carbon\Carbon::parse($chamado->created_at)->format('d/m/Y H:i')}}
                </div>
            </div>
            <div class="campos-item">
                <b>Solicitante</b>
                <div>
                    {{ $chamado->solicitante}}
                </div>
            </div>
            <div class="campos-item">
                <b>Categoria:</b> <br/>
                <div>
                    {{$chamado->subcategoria->categoria->nome}} - {{$chamado->subcategoria->nome}}
                </div>
                <div class="ui search fluid selection dropdown d-none">
                    <input type="hidden" id="categoria_id" name="categoria_id" value="{{$chamado->subcategoria->id}}">
                    <i class="dropdown icon"></i>
                    <div class="default text">{{$chamado->subcategoria->categoria->setor->nome}} - {{$chamado->subcategoria->categoria->nome}}</div>
                    <div class="menu">
                        <div class="item" data-value="{{$chamado->subcategoria->id}}">{{$chamado->subcategoria->categoria->setor->nome}} - {{$chamado->subcategoria->categoria->nome}}</div>
                        @foreach($subcategorias->whereNotIn('id', $chamado->subcategoria->id) as $subcategoria)
                            <div class="item" data-value="{{$subcategoria->id}}"> {{$subcategoria->categoria->setor->nome}} - {{$subcategoria->categoria->nome}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="campos-item">
                <b>E-mail</b>
                <div>
                    <a class="popup" data-content="Abrir com aplicativo externo" href="mailto:{{ $chamado->email}}">{{ $chamado->email}} <i class="external alternate icon"></i></a>
                </div>
            </div>
            <div class="campos-item">
                <b>Telefone</b>
                <div class="popup">
                    2199999-3333
                </div>
            </div>
            <div class="campos-item">
                <b>Data conclusão</b>
                <div class="date">
                    @if($chamado->data_conclusao) {{ Carbon\Carbon::parse($chamado->data_conclusao)->format('d/m/Y H:i')}} @else <br/> @endif
                </div>
            </div>
        </div>
    </div>
    <div class="scrolling" style="display:flex; flex: 2; flex-direction: column; padding: 10px">
        <div style="flex: 3;">
            <form method="POST" action="{{route('chamados.update', ['chamado' => $chamado->id])}}" id="form_chamado" enctype="multipart/form-data">
                @if(Auth::user()->id == $chamado->solicitante_id || Auth::user()->setor_id == $chamado->subcategoria->categoria->setor->id)
                <div class="ui form" style="flex: 1">
                    @csrf
                    @method('PUT')
                    <div class="field">
                        <label>Descreva o problema/situação:</label>
                        <textarea id="mensagem" name="mensagem" rows="3"></textarea>
                        <div style="padding: 2px">
                            <label for="file" class="ui icon button" style="max-width: 200px">
                                <i class="file icon"></i>
                                Anexar arquivo</label>
                            <input name="anexos[]" type="file" id="file" style="display:none">
                        </div>
                    </div>
                </div>
                @endif
                <div class="image content">
                    @if($chamado->anexos->count())
                    <div class="ui very relaxed horizontal list">
                        @foreach ($chamado->anexos as $anexo)
                            <div class="item">
                                <img class="ui avatar image" src="https://semantic-ui.com/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <a class="header" href="{{asset('storage'.$anexo->anexo)}}" target="_blank">{{\File::extension($anexo->anexo)}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                    <div class="description">
                        <div class="ui comments" id="conversa">
                            <h3 class="ui dividing header">Conversa</h3>
                            <div class="comment">
                                <a class="avatar">
                                    <img src="https://semantic-ui.com/images/avatar/small/elliot.jpg">
                                </a>
                                <div class="content">
                                    <a class="author">{{$chamado->solicitante}}</a>
                                    <div class="metadata">
                                        <span class="date">{{date('d/m/Y H:i', strtotime($chamado->created_at))}}</span>
                                    </div>
                                    <div class="ui visible message" style="white-space: pre-wrap">{{$chamado->solicitacao}}</div>
                                </div>
                            </div>
                            @foreach ($chamado->mensagens as $mensagem)
                            <div class="comment">
                                <a class="avatar">
                                    <img src="https://semantic-ui.com/images/avatar/small/elliot.jpg">
                                </a>
                                <div class="content">
                                    <a class="author">{{$mensagem->remetente->name}}</a>
                                    <div class="metadata">
                                        <span class="date">{{date('d/m/Y H:i', strtotime($mensagem->created_at))}}</span>
                                    </div>
                                    <div class="ui visible message" style="white-space: pre-wrap">{{$mensagem->mensagem}}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="actions">
                @if (Auth::user()->setor_id == $chamado->subcategoria->categoria->setor->id && $chamado->status != 'encerrado')
                    <div class="ui checkbox">
                        <input type="checkbox" name="status" value="encerrado" id="status">
                        <label for="status">Encerrar</label>
                    </div>
                    {{-- <form method="POST" action="{{ route('chamados.update', ['chamado' => $chamado->id]) }}" hidden>
                        @csrf
                        @method('put')
                        <input name="status" type="text" value="encerrado">
                    </form> --}}
                    {{-- <button class="ui negative right labeled icon button"
                    onclick="this.previousElementSibling.submit()">
                        Encerrar chamado
                        <i class="checkmark icon"></i>
                    </button> --}}
        
                @elseif((Auth::user()->setor_id == $chamado->subcategoria->categoria->setor->id || Auth::user()->id == $chamado->solicitante_id) && $chamado->status == 'encerrado')
                    <div class="ui checkbox">
                        <input type="checkbox" name="status" value="encerrado" id="status">
                        <label for="status">Reabrir</label>
                    </div>
                    <button class="ui positive right labeled icon button">
                        Enviar mensagem
                        <i class="paper plane icon"></i>
                    </button>
                @endif
                @if ((Auth::user()->id == $chamado->solicitante_id || Auth::user()->setor_id == $chamado->subcategoria->categoria->setor->id) && $chamado->status != 'encerrado')
                <button class="ui positive right labeled icon button">
                    Enviar mensagem
                    <i class="paper plane icon"></i>
                </button>
                    {{-- <button class="ui positive right labeled icon button"
                        onclick="enviarMensagem({remetente_id: {{ Auth::user()->id}},
                        chamado_id: {{$chamado->id}}})">
                        Enviar mensagem
                        <i class="paper plane icon"></i>
                    </button> --}}
                @endif
            </div>    
            </form>
        </div>
    </div>
</div>
<script>
    $('.popup').popup();
</script>
@endsection