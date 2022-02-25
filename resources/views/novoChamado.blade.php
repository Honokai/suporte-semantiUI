
<i class="close icon"></i>
<div class="header" id="modal-header">
    Novo chamado
</div>
<style>
    .modal-header {
        color: white;
        font-size: 15px;
        line-height: 1.5rem;
    }
</style>
<div style="display:flex; flex-direction: row; padding: 10px">
    <div class="ui medium image" style="flex:1; padding: 10px 7px 5px 7px; background-color: rgb(63, 116, 230); border-radius: 10px; margin: 0px 5px 0px 5px">
        <div class="modal-header">
            <div>
                <b>Solicitante:</b> <br/>
                <input id="solicitante_id" name="solicitante_id" type="text" hidden value="{{Auth::user()->id}}">
                @csrf
            </div>
            <div style="border-radius: 0.28571429rem;font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif; border: 0; padding: 3px 10px 3px 10px; background-color: white; outline:none; cursor: default;line-height: 1.21428571em;
            padding: 10px; color: black">
                {{Auth::user()->name}}
            </div>
            <div>
                <b>Setor:</b> <br/>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" id="setor_id" name="setor_id">
                    <i class="dropdown icon"></i>
                    <div class="default text">Selecione o setor</div>
                    <div class="menu">
                        @foreach($setores->all() as $setor)
                        <div class="item" data-value="{{$setor->id}}">{{$setor->nome}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div>
                <b>Localizacao:</b> <br/>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" id="localizacao_id" name="localizacao_id">
                    <i class="dropdown icon"></i>
                    <div class="default text">Informe a localização:</div>
                    <div class="menu">
                        @foreach($localizacoes->all() as $localizacao)
                            <div class="item" data-value="{{$localizacao->id}}"> {{$localizacao->localizacao}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div>
                <b>Categoria:</b> <br/>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" id="categoria_id" name="categoria_id">
                    <i class="dropdown icon"></i>
                    <div class="default text">Categoria do problema:</div>
                    <div class="menu">
                        @foreach($categorias->all() as $categoria)
                        <div class="item" data-value="{{$categoria->id}}"> {{$categoria->setor->nome}} - {{$categoria->categoria}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="flex:3">
        <div class="ui form">
            <div class="field">
                <label>Descreva o problema/situação:</label>
                <textarea id="mensagem" name="mensagem"></textarea>
                <div style="padding: 2px">
                    <label for="file" class="ui icon button" style="max-width: 200px">
                        <i class="file icon"></i>
                        Anexar arquivo</label>
                    <input name="anexos[]" type="file" id="file" style="display:none">
                </div>
            </div>
        </div>

    </div>
</div>
<div class="actions">
    <button class="ui positive right labeled icon button" onclick="enviarFormularioAbertura()">
        Abrir chamado
        <i class="paper plane icon"></i>
    </button>
</div>
