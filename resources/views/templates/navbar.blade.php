<div class="ui top attached menu">
    <div class="item">
        <img src="/imagem/padrao.png">
    </div>
    <a href="{{route('dashboard')}}" class="ui item">
        Dashboard
    </a>
    <div class="ui dropdown icon item">
        <i class="wrench icon"></i>
        <div class="menu">
            <div class="item" onclick="abrirModal(0)">
                Novo chamado
            </div>
            <div class="divider"></div>
            <div class="header">
                Setores
            </div>
            <a href="/chamados/ti" class="ui item">
                TI
            </a>
            <div class="divider"></div>
            <div class="item">Edit Permissions</div>
            <div class="divider"></div>
            @auth
                @if (Auth::user()->nivel == 'admin')
                    <div class="header">
                        Administração
                    </div>
                    <div class="item">
                        <i class="dropdown icon"></i>
                        <span class="text">Categoria</span>
                        <div class="menu">
                            <a href="{{route('categorias.create')}}" class="item">Nova</a>
                            <a href="{{route('categorias.index')}}" class="item">Gerenciar</a>
                        </div>
                    </div>
                    <div class="item">
                        <i class="dropdown icon"></i>
                        <span class="text">Setor</span>
                        <div class="menu">
                            <a href="{{route('setores.create')}}" class="item">Novo</a>
                            <a href="#" class="item">Gerenciar</a>
                        </div>
                    </div>
                    <div class="item">
                        <i class="dropdown icon"></i>
                        <span class="text">Usuário</span>
                        <div class="menu">
                            <div class="item">Novo</div>
                            <div class="item">Gerenciar</div>
                        </div>
                    </div>
                @endif
            @endauth

            <form class="item" method="POST" action="/sair" onclick="this.submit()">
                @csrf
                <a
                    href="/sair" onclick="event.preventDefault();
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