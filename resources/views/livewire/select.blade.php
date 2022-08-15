<div>
    @livewireStyles
    <div class="row" style="margin-top: 10px;">
        <div class="ui fluid labeled search selection dropdown @error('subcategoria_id') error @enderror" @error('subcategoria_id') data-content="{{$message}}" @enderror>
            <input  @if($selected) value="{{$selected}}" @endif type="hidden" id="categoria_id" name="subcategoria_id">
            <i class="dropdown icon"></i>
            <div class="default text">Categoria do problema</div>
            <div class="menu">
                @foreach($subcategorias as $subcategoria)
                    <div class="item" data-value="{{$subcategoria->id}}"> ({{$subcategoria->categoria->setor->nome}}) {{ $subcategoria->categoria->nome }} - {{ $subcategoria->nome }}</div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@if($mostrarAdicional)
<div>
    <div class="row" style="margin-top: 10px;">
        <div class="ui fluid labeled search selection dropdown @error('subcategoria_id') error @enderror" @error('subcategoria_id') data-content="{{$message}}" @enderror>
            <input type="hidden" id="categoria_id" name="subcategoria_id">
            <i class="dropdown icon"></i>
            <div class="default text">{{$mostrarAdicional}}</div>
            <div class="menu">
                @foreach($subcategorias as $subcategoria)
                    <div class="item" data-value="{{$subcategoria->id}}"> ({{$subcategoria->categoria->setor->nome}}) {{ $subcategoria->categoria->nome }} - {{ $subcategoria->nome }}</div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
@livewireScripts