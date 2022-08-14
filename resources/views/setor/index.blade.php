@extends('templates.layout', ['navbar' => true, 'titulo' => 'Setores'])
@section('conteudo')
<div class="ui container">
@if(session('mensagem'))
<h1>
{{session('mensagem')}}
</h1>
@endif
    @foreach ($setores as $setor)
        <div style="display: flex; width: 100%; background: rgb(121, 156, 144); padding: .6rem">
            <div style="flex:1">{{$setor->nome}}</div>
            <div style="display:flex; flex:1; justify-content:end">
            <form style="display: inline" action="{{route('setores.destroy',['setore' => $setor->id])}}" method="POST">
                @csrf
                @method("DELETE")
                <button class="ui red button" type="submit">Apagar</a>
            </form>
            <button class="ui primary button">Editar</button></div>
        </div>
    @endforeach
</div>
@endsection