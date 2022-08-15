@extends('templates.layout')
@section('conteudo')
<style>
    .scrolling {
        overflow: hidden;
        overflow-y: auto;
    }
    
    .print:hover {
        filter: brightness(0.9);
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

        .actions {
            display: none;
        }
    }

    .d-none {
        display: none !important;
    }

    .px-1 {
        padding: 0 1rem !important;
    }

   .py-1 {
        padding: 1rem 0 !important;
    }

    .m-1 {
        margin: 1rem !important;
    }

    .p-1 {
        padding: 0 .5rem;
    }

    .medium {
        font-size: 1.15rem;
    }

    .large {
        font-size: 1.3rem;
    }

    .ui.card {
        background: #8fb6ff;
        border: #528fff 1px solid;
    }

    .ui.card > .content > .header {
        color: rgb(255, 255, 255) !important;
        border-bottom: 0.2rem solid rgb(82, 120, 191);
    }

    .ui.card > .content > .description {
        color: rgb(255, 255, 255) !important;
    }
</style>
@if(session('suporte'))
    <script>
        window.parent.location.href = "{{route('chamado.index', ['nomeSetor' => session('suporte')])}}"
    </script>
@endif
<div class="ui fluid container" style="margin: 0 !important; height: 100%; display:flex">
    <div class="ui card m-1">
        <div class="content">
            <div class="header p-1">
                Chamado #{{ $chamado->id }} - {{Illuminate\Support\Str::title(App\Enums\StatusTipo::getKey(intval($chamado->status)))}}
            </div>
            <div class="description large py-1">
                <button class="print" onclick="parent.printIframe()"><i class="print icon"></i></button>
            </div>
            <div class="description medium">
                <b>Data abertura:</b>
                <div class="date">
                    {{ Carbon\Carbon::parse($chamado->created_at)->format('d/m/Y H:i')}}
                </div>
            </div>
            <div class="description medium">
                <b>Solicitante:</b>
                <div>
                    {{ $chamado->solicitante}}
                </div>
            </div>
            <div class="description medium">
                <b>Categoria:</b> <br/>
                <div>
                    {{$chamado->subcategoria->categoria->nome}} - {{$chamado->subcategoria->nome}}
                </div>
            </div>
            <div class="description medium">
                <b>E-mail:</b>
                <div>
                    <a class="popup" data-content="Abrir com aplicativo externo" href="mailto:{{ $chamado->email}}">{{ $chamado->email}} <i class="external alternate icon"></i></a>
                </div>
            </div>
            <div class="description medium">
                <b>Telefone:</b>
                <div class="popup">
                    2199999-3333
                </div>
            </div>
            <div class="description medium">
                <div class="campos-item">
                    <b>Data conclusão:</b>
                    <div class="date">
                        @if($chamado->data_conclusao) {{ Carbon\Carbon::parse($chamado->data_conclusao)->format('d/m/Y H:i')}} @else <br/> @endif
                    </div>
                </div>
            </div>
            
            <div class="description">
                
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
                    </div>
                    <div class="ui middle aligned grid">
                        <div class="column">
                            <div style="padding: 2px; display:block">
                                <label for="file" class="ui icon button" style="max-width: 200px">
                                    <i class="file icon"></i>
                                    Anexar arquivo</label>
                                <input name="anexos[]" type="file" id="file" style="display:none">
                                @if (Auth::user()->setor_id == $chamado->subcategoria->categoria->setor->id && $chamado->status != 3)
                                    <div class="ui checkbox">
                                        <input type="checkbox" name="status" value="encerrado" id="status">
                                        <label for="status">Encerrar</label>
                                    </div>
                                    @elseif((Auth::user()->setor_id == $chamado->subcategoria->categoria->setor->id || Auth::user()->id == $chamado->solicitante_id) && $chamado->status == 3)
                                    <div class="ui checkbox">
                                        <input type="checkbox" name="status" value="reaberto" id="status">
                                        <label for="status">Reabrir</label>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="left aligned column">
                            <div class="ui checkbox">
                                <input type="checkbox" name="status" value="encerrado" id="status">
                                <label for="status">Encerrar</label>
                            </div>
                        </div> --}}
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
                                    <a class="header" href="{{asset('storage/'.$anexo->caminho)}}" target="_blank">{{$anexo->nome}}</a>
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
                @if (Auth::user()->setor_id == $chamado->subcategoria->categoria->setor->id && $chamado->status != 3)
                    <div class="ui checkbox">
                        <input type="checkbox" name="status" value="encerrado" id="status">
                        <label for="status">Encerrar</label>
                    </div>
        
                @elseif((Auth::user()->setor_id == $chamado->subcategoria->categoria->setor->id || Auth::user()->id == $chamado->solicitante_id) && $chamado->status == 3)
                    <button class="ui positive right labeled icon button">
                        Enviar mensagem
                        <i class="paper plane icon"></i>
                    </button>
                @endif
                @if ((Auth::user()->id == $chamado->solicitante_id || Auth::user()->setor_id == $chamado->subcategoria->categoria->setor->id) && $chamado->status != 3)
                <button class="ui positive right labeled icon button">
                    Enviar mensagem
                    <i class="paper plane icon"></i>
                </button>
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