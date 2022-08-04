@extends('templates.layout', ['titulo' => "Listar categorias"])
@section('conteudo')

@if(session('mensagem'))
<h1>
{{session('mensagem')}}
</h1>
@endif
<table class="ui fixed table">
    <thead>
        <tr>
            <th>Categoria</th>
            <th>Setor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($categorias as $categoria)
          <tr>
            <td>{{$categoria->categoria}}</td>
            <td>{{$categoria->setor->nome}}</td>
            <td>
                <form style="display: inline" action="{{route('categorias.destroy',['categoria'=>$categoria->id])}}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="ui red button" type="submit"">Apagar</a>
                </form>
                <button class="ui primary button">Editar</button>
            </td>
          </tr>
    @endforeach
    </tbody>
</table>
@endsection