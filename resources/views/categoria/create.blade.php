@extends('templates.layout', ['titulo' => "Criar categoria", 'navbar' => true])
@section('conteudo')
<div class="ui container">
    <form action="{{route('categorias.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="ui fluid labeled search selection dropdown @error('subcategoria_id') error @enderror" @error('subcategoria_id') data-content="{{$message}}" @enderror>
                <input type="hidden" id="categoria_id" name="subcategoria_id">
                <i class="dropdown icon"></i>
                <div class="default text">Categoria</div>
                <div class="menu">
                    {{-- @foreach($subcategorias as $subcategoria)
                        <div class="item" data-value="{{$subcategoria->id}}"> ({{$subcategoria->categoria->setor->nome}}) {{ $subcategoria->categoria->nome }} - {{ $subcategoria->nome }}</div>
                    @endforeach --}}
                </div>
            </div>
        </div>
        <button class="ui positive right labeled icon button">
            Abrir chamado
            <i class="paper plane icon"></i>
        </button>
    </form>
</div>
@endsection
