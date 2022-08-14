<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($titulo) ? "$titulo - Suporte" : "Suporte"}}</title>
    <link rel="stylesheet" href="/css/semantic.css">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/semantic.min.js"></script>
    <script src="/js/semanticINIT.js"></script>
    @yield('head')
</head>
<body>
    @isset($navbar)
        @include('templates.navbar')
    @endisset
    @yield('conteudo')
    <div class="ui longer modal" id="modal">
        <iframe src="" id="iframe" style="height: 70vh; width: 100%" frameborder="0">
        </iframe>
    </div>
</body>
</html>
