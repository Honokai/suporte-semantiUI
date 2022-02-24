@extends('templates.layout',['titulo'=> "Criar setor", 'navbar' => true])
@section('conteudo')
<div class="ui container">
    <div class="ui centered grid">
        <form class="ui form" action="{{route('setores.store')}}" method="POST">
            @if(session('sucesso'))
                <div class="ui success message">
                    <i class="close icon"></i>
                    <div class="header">
                    Your user registration was successful.
                    </div>
                    <p>You may now log-in with the username you have chosen</p>
                </div>
            @endisset
            <div class="field">
                <label>Nome do setor</label>
                <input type="text" name="nome" placeholder="Tecnologia da informacao" value="{{ old('capa') }}">
                @error('nome')
                    <div class="alert alert-danger" style="padding: 0.5rem">{{ $message }}</div>
                @enderror
            </div>
            @csrf
            <div class="field">
                <label>Gestor do setor</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="responsavel">
                    <i class="dropdown icon"></i>
                    <div class="default text">Colaborador</div>
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

@endsection