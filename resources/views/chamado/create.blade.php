@extends('templates.layout')
@section('conteudo')
<style>
    .modal-header {
        color: white;
        font-size: 15px;
        line-height: 1.5rem;
        flex: 1;
        background-color: rgb(63, 116, 230);
        padding: 10px 7px 5px 7px;
        border-radius: 10px;
        margin: 0px 5px;
    }

    .py-1 {
        padding: 1rem 0;
    }
</style>

@if(session('suporte'))
    <script>
        window.parent.location.href = "{{route('chamado.index', ['nomeSetor' => session('suporte')])}}"
    </script>
@endif
<form method="POST" action="{{route('chamados.store')}}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="solicitante_id" value="{{Auth::user()->id}}">
    <div class="ui container py-1" style="height: 100vh">
        <div style="padding: 10px 0;">
            <div class="ui three column grid">
                <div class="row">
                    <div class="column">
                        <div class="ui labeled fluid input @error('telefone') error @enderror" @error('telefone') data-content="{{$message}}" @enderror>
                            <div class="ui label">
                            Telefone
                            </div>
                            <input name="telefone" type="text" value="{{old('telefone')}}" placeholder="21988885555">
                        </div>
                    </div>
                    <div class="column">
                        <div class="ui labeled fluid input @error('email') error @enderror" @error('email') data-content="{{$message}}" @enderror>
                            <div class="ui label">
                                E-mail
                            </div>
                            <input name="email" type="email" value="{{Auth::user()->email}}" placeholder="exemplo157@dominio.com">
                        </div>
                    </div>
                    <div class="column">
                        <div class="ui labeled fluid input @error('ramal') error @enderror" @error('ramal') data-content="{{$message}}" @enderror>
                            <div class="ui label">
                                Ramal
                            </div>
                            <input name="ramal" type="text" placeholder="2015">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="ui fluid labeled search selection dropdown @error('subcategoria_id') error @enderror" @error('subcategoria_id') data-content="{{$message}}" @enderror>
                    <input type="hidden" id="categoria_id" name="subcategoria_id">
                    <i class="dropdown icon"></i>
                    <div class="default text">Categoria do problema</div>
                    <div class="menu">
                        @foreach($subcategorias as $subcategoria)
                            <div class="item" data-value="{{$subcategoria->id}}"> ({{$subcategoria->nome}}) {{ $subcategoria->categoria_nome }} - {{ $subcategoria->subcategoria_nome }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="ui form">
                    <div class="field @error('solicitacao') error @enderror" @error('solicitacao') data-content="{{$message}}" @enderror>
                        <label>Descreva o problema/situação:</label>
                        <textarea id="solicitacao" name="solicitacao"></textarea>
                    </div>
                    <div style="padding: 2px">
                        <label for="file" class="ui icon button" style="max-width: 200px">
                            <i class="file icon"></i>
                            Anexar arquivo</label>
                        <input name="anexos[]" type="file" id="file" style="display:none">
                        <span></span>
                    </div>
                </div>
            </div>
            <div style="flex: 1; text-align: right">
                <button class="ui positive right labeled icon button">
                    Abrir chamado
                    <i class="paper plane icon"></i>
                </button>
            </div>
        </div>
    </div>
</form>

@if(!$errors->isEmpty())
    <script>
        $('.column .ui').popup();
        $('.row .ui').popup();
        $('.ui .form .field').popup();
    </script>
@endif

<script>
    $(document).ready(function () {
        document.getElementById('file').addEventListener('change', (e) => {
            console.log(e.target.files)
            e.currentTarget.nextElementSibling.innerHTML = e.currentTarget.files[0].name
        })
    })
</script>
</div>
@endsection
