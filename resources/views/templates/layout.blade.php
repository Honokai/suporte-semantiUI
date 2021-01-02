<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Testing view</title>
    <link rel="stylesheet" href="/css/semantic.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/semantic.min.js"></script>
    <script src="/js/semanticINIT.js"></script>
    
</head>
<body>
    @if(!isset($navbar))
    <div class="ui top attached menu">
        <div class="item">
            <img src="/imagem/padrao.png">
        </div>
        <div class="ui dropdown icon item">
            <i class="wrench icon"></i>
            <div class="menu">
                <div class="item">
                    <i class="dropdown icon"></i>
                    <span class="text" onclick="abrirModal(0)">Novo chamado</span>
                    <div class="menu">
                        <div class="item">Document</div>
                        <div class="item">Image</div>
                    </div>
                </div>
                <div class="item">
                    Open...
                </div>
                <div class="item">
                    Save...
                </div>
                <div class="item">Edit Permissions</div>
                <div class="divider"></div>
                <div class="header">
                    Export
                </div>
                <form class="item" method="POST" action="http://localhost:8000/sair" onclick="this.submit()">
                    @csrf
                    <a
                        href="http://localhost:8000/sair" onclick="event.preventDefault();
                        this.closest('form').submit();"
                    >Sair</a>
                </form>
            </div>
        </div>
        <div class="ui dropdown icon item">
            <i class="search link icon"></i>
        </div>
        <div class="right menu">
          <div class="ui right aligned category search item">
            <div class="ui transparent icon input">
              <input class="prompt" type="text" placeholder="Pesquisa chamados...">
              <i class="search link icon"></i>
            </div>
            <div class="results"></div>
          </div>
        </div>
    </div>
    <div class="ui bottom attached segment">
        <p></p>
    </div>  
    @endif
    @yield('conteudo')
</body>
</html>