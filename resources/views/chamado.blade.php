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
</style>
<div style="display:flex; flex-direction: row; padding: 10px">
    <div class="ui medium image" style="flex:1; padding: 10px 7px 5px 7px; background-color: rgb(63, 116, 230); border-radius: 10px; margin: 0px 5px 0px 5px">
        <div class="modal-header">
            <div>
                <b>Solicitação:</b><br/>
                <span style="background-color: rgb(255, 255, 255); color: gray; padding: 3px; border-radius: 25px">{{$chamado->id}}</span> 
            </div>
            <div>
                <b>Solicitante:</b> <br/>
                <span style="background-color: rgb(255, 255, 255); color: gray; padding: 3px; border-radius: 25px">{{$chamado->solicitante->name}}</span>
            </div>
            <div>
                <b>Setor:</b> <br/>
                <span style="background-color: rgb(255, 255, 255); color: gray; padding: 3px; border-radius: 25px">{{$chamado->setor->setor}}</span>
            </div>
            <div>
                <b>Localizacao:</b> <br/>
                <span style="background-color: rgb(255, 255, 255); color: gray; padding: 3px; border-radius: 25px">{{$chamado->localizacao->localizacao}}</span>
            </div>
        </div>
    </div>
    <div style="flex:3">
        <div class="ui form">
            <div class="field">
                <form id="form_chamado">
                    @csrf
                    <label>Descreva o problema/situação:</label>
                    <textarea id="mensagem" name="mensagem"></textarea>
                    <div style="padding: 2px">
                        <label for="file" class="ui icon button" style="max-width: 200px">
                            <i class="file icon"></i>
                            Anexar arquivo</label>
                        <input type="file" id="file" style="display:none">
                    </div>
                </form>
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
                            <span class="date">{{$mensagem->created_at}}</span>
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
    <button class="ui positive right labeled icon button" 
        onclick="enviarMensagem({remetente_id: {{ Auth::user()->id}}, 
        chamado_id: {{$chamado->id}}})">
        Enviar mensagem
        <i class="checkmark icon"></i>
    </button>
</div>