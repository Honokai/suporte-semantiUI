<i class="close icon"></i>
<div class="header" id="modal-header">
    Chamado
</div>
<style>
    .modal-header{
        color: white;
        font-size: 15px;
        line-height: 1.5rem;
    }
    .dados-chamado {
        background-color: rgb(255, 255, 255); 
        color: black;
        padding: 3px 10px 3px 10px; 
        border-radius: 0.28571429rem;
    }
</style>
<div style="display:flex; flex-direction: row; padding: 10px">
    <div class="ui medium image" style="flex:1; padding: 10px 7px 5px 7px; background-color: rgb(63, 116, 230); border-radius: 10px; margin: 0px 5px 0px 5px">
        <div class="modal-header">
            <div>
                <b>Solicitação:</b><br/>
                <span class="dados-chamado">{{$chamado->id}}</span> 
            </div>
            <div>
                <b>Solicitante:</b> <br/>
            </div>
            <div style="border-radius: 0.28571429rem;font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif; border: 0; background-color: white; line-height: 1.31428571em;
            padding: 10px; color: black; max-height: 38px !important; max-width: 214px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                {{$chamado->solicitante->name}}
            </div>
            <div>
                <b>Setor:</b> <br/>
            </div>
            <div style="border-radius: 0.28571429rem;font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif; border: 0; background-color: white; line-height: 1.31428571em;
            padding: 10px; color: black; max-height: 38px !important; max-width: 214px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                {{$chamado->setor->setor}}
            </div>
            <div>
                <b>Localizacao:</b> <br/>
            </div>
            <div style="border-radius: 0.28571429rem;font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif; border: 0; background-color: white; line-height: 1.31428571em;
            padding: 10px; color: black; max-height: 38px !important; max-width: 214px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                {{$chamado->localizacao->localizacao}}
            </div>
            <div>
                <b>Categoria:</b> <br/>
            </div>
            <div style="border-radius: 0.28571429rem;font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif; border: 0; background-color: white; line-height: 1.31428571em;
            padding: 10px; color: black; max-height: 38px !important; max-width: 214px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                {{$chamado->categoria->setor->setor}} - {{$chamado->categoria->categoria}}
            </div>
        </div>
    </div>
    <div style="flex:3">
        <div class="ui form">
            <div class="field">
                @if (Auth::user()->id == $chamado->solicitante->id || Auth::user()->setor_id == $chamado->setor->id)
                <form id="form_chamado">
                    @csrf
                    <label>Descreva o problema/situação:</label>
                    <textarea id="mensagem" name="mensagem"></textarea>
                    <div style="padding: 2px">
                        <label for="file" class="ui icon button" style="max-width: 200px">
                            <i class="file icon"></i>
                            Anexar arquivo</label>
                        <input name="anexos[]" type="file" id="file" style="display:none">
                    </div>
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
                </form>
                @endif
            </div>
        </div>
        <div class="scrolling image content" style="max-height: 280px">
            <div class="description">
                <div class="ui comments" id="conversa">
                    <h3 class="ui dividing header">Conversa</h3>
                    @foreach ($chamado->mensagens as $mensagem)
                    <div class="comment">
                        <a class="avatar">
                            <img src="https://semantic-ui.com/images/avatar/small/elliot.jpg">
                        </a>
                        <div class="content">
                            <a class="author">{{$mensagem->remetente->name}}</a>
                            <div class="metadata">
                            <span class="date">{{date( 'd/m/Y H:i', strtotime($mensagem->created_at))}}</span>
                            </div>
                            <div class="text">
                            {{$mensagem->mensagem}}
                            </div>
                            <div class="actions">
                            <a class="reply">Reply</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="actions">
    @if (Auth::user()->setor_id == $chamado->setor->id && $chamado->status != 'encerrado')
    <form method="POST" action="{{ route('chamados.update', ['chamado' => $chamado->id]) }}" hidden>
        @csrf
        @method('put')
        <input name="status" type="text" value="encerrado">
    </form>
    <button class="ui negative right labeled icon button" 
    onclick="this.previousElementSibling.submit()">
        Encerrar chamado
        <i class="checkmark icon"></i>
    </button>
    @elseif(Auth::user()->setor_id == $chamado->setor->id && $chamado->status == 'encerrado')
    <form method="POST" action="{{ route('chamados.update', ['chamado' => $chamado->id]) }}" hidden>
        @csrf
        @method('put')
        <input name="status" type="text" value="reaberto">
    </form>
    <button class="ui negative right labeled icon button" 
    onclick="this.previousElementSibling.submit()">
        Reabrir chamado
        <i class="checkmark icon"></i>
    </button>
    @endif
    @if ((Auth::user()->id == $chamado->solicitante->id || Auth::user()->setor_id == $chamado->setor->id) && $chamado->status != 'encerrado')
    <button class="ui positive right labeled icon button" 
        onclick="enviarMensagem({remetente_id: {{ Auth::user()->id}}, 
        chamado_id: {{$chamado->id}}})">
        Enviar mensagem
        <i class="paper plane icon"></i>
    </button>
    @endif
    
</div>