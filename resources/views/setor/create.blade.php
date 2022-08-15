@extends('templates.layout')
@section('conteudo')
<div class="ui container" style="height: 100%; display:flex; align-items: center; justify-content: center">
    <div class="ui centered grid">
        <form class="ui form" action="{{route('setores.store')}}" method="POST">
            <div class="field @error('nome') error @enderror" @error('nome') data-content="{{$message}}" @enderror>
                <label>Nome do setor</label>
                <input type="text" name="nome" placeholder="Contábil" value="{{ old('capa') }}">
            </div>
            @csrf
            <div class="field">
                <label>Gestor do setor</label>
                <div class="ui selection dropdown @error('responsavel_id') error @enderror" @error('responsavel_id') data-content="{{$message}}" @enderror>
                    <input type="hidden" name="responsavel_id">
                    <i class="dropdown icon"></i>
                    <div class="default text ">Colaborador</div>
                    <div class="menu">
                        @foreach ($usuarios as $usuario)
                            <div class="item" data-value="{{$usuario->id}}">{{$usuario->name}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
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