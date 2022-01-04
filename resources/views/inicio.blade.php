@extends('templates.layout',['titulo'=> "Início", 'navbar' => true])

@section('conteudo')
    <div class="ui text attached menu">
        <div class="item">
            <i class="desktop icon"></i>
        </div>
        <div class="ui dropdown item">
            Menu
            <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item">Funcionalidades</a>
                <a class="item">Demonstração</a>
                @if (Auth::check())
                <a class="item" href="/chamados/setor/{{Auth::user()->setor->nome}}">Chamados</a>
                @endif
            </div>
        </div>
        @if (!Auth::check())
        <a class="ui left item" href="{{route('login')}}">
            Entrar
        </a>
        @else
        <form class="item" method="POST" action="/sair" onclick="this.submit()">
            @csrf
            <a class="item"
                href="/sair" onclick="event.preventDefault();
                this.closest('form').submit();"
            >Sair</a>
        </form>
        @endif
        
        <div class="ui right dropdown item">
            Mais
            <i class="dropdown icon"></i>
            <div class="menu">
                <div class="item">Sobre nós</div>
                <div class="item">Sobre a aplicação</div>
            </div>
        </div>
    </div>

@endsection