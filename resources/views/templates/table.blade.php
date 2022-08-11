<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $titulo ?? 'Suporte' }}</title>
    <link rel="stylesheet" href="/css/semantic.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/custom.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/semantic.min.js"></script>
    <script src="/js/semanticINIT.js"></script>
    @livewireStyles
    @powerGridStyles
</head>
<body>
    @isset($navbar)
        @include('templates.navbar')
    @endisset
    @yield('conteudo')
    @livewireScripts
    @powerGridScripts
</body>
</html>
