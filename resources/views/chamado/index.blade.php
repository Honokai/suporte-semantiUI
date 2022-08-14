@extends('templates.table', ['navbar' => true])
@section('conteudo')
<div class="ui fluid container" style="padding: 0 2rem">
    <livewire:chamado-table setor="{{$setor}}"/>
    <script>
        function printIframe() {
            document.getElementById('iframe').contentWindow.print()
        }
    </script>
</div>
@endsection