@extends('templates.table', ['navbar' => true])
@section('conteudo')
    <livewire:chamado-table setor="{{$setor}}"/>
    <script>
        function printIframe() {
            document.getElementById('iframe').contentWindow.print()
        }
    </script>
@endsection