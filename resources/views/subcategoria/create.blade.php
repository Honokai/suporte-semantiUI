@extends('templates.layout')
@section('conteudo')
@if(session('refresh'))
    <script>
        window.parent.location.href = "{{route('categorias.index')}}"
    </script>
@endif
<div class="ui container" style="height: 100%; display:flex; align-items: center; justify-content: center">
    <div class="ui centered grid" style="width: 80%">
        <form class="ui form" action="{{route('subcategorias.store')}}" style="width: 100%;" method="POST">
            @csrf
            <input type="hidden" name="categoria_id" value="{{$categoria}}">
            <div class="column">
                <div class="ui labeled fluid input @error('nome') error @enderror" @error('nome') data-content="{{$message}}" @enderror>
                    <div class="ui label">
                    Nome
                    </div>
                    <input name="nome" type="text" value="{{old('nome')}}" placeholder="Alteração de valores">
                </div>
            </div>
            {{-- <div class="field" style="margin: 0.2rem 0">
                <textarea name="template" rows="10" placeholder="Informe aqui itens essenciais para que o usuãrio preencha no momento da abertura do chamado"></textarea>
            </div> --}}
            <button class="ui button" type="submit">Enviar</button>
        </form>
    </div>
</div>
@if(!$errors->isEmpty())
    <script>
        $('.column .ui').popup();
        $('.row .ui').popup();
        $('.ui .form .field').popup();
        $('.ui .selection').popup();
    </script>
@endif
@endsection