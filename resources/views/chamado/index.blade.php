@extends('templates.table', ['navbar' => true])
@section('conteudo')
    <livewire:chamado-table setor="{{$setor}}"/>
    <div class="ui longer modal" id="modal">
        <iframe src="" id="iframe" style="height: 70vh; width: 100%" frameborder="0">
        </iframe>
    </div>
@endsection