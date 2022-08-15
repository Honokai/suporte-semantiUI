@extends('templates.layout', ['navbar' => true, 'titulo' => 'Setores'])
@section('conteudo')
<div class="ui container">
@foreach ($categorias as $categoria)
    <div style="display: flex; width: 100%; background: rgb(121, 156, 144); padding: .6rem">
        <div style="flex:1">{{$categoria->nome}}</div>
        <div style="display:flex; flex:1; justify-content:end">
            <form style="display: inline" action="{{route('categorias.destroy',['categoria'=>$categoria->id])}}" method="POST">
                @csrf
                @method('delete')
                <button class="ui red button" type="submit">Apagar</a>
            </form>
        <button class="ui primary button">Editar</button></div>
    </div>
    @foreach ($categoria->subcategorias as $subcategoria)
    <div style="display: flex; width: 100%; padding: .6rem">
        <div style="flex:1">{{$subcategoria->nome}}</div>
        <div style="display:flex; flex:1; justify-content:end">
            <form style="display: inline" action="{{route('categorias.destroy',['categoria'=>$subcategoria->id])}}" method="POST">
                @csrf
                @method('delete')
                <button class="ui red button" type="submit">Apagar</a>
            </form>
        <button class="ui primary button">Editar</button></div>
    </div>      
    @endforeach
@endforeach
</div>
@endsection