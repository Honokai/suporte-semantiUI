@extends('templates.layout', ['titulo'=>"Visão geral", 'navbar' => true])
@section('conteudo')
    <div>
        <div class="ui container">
            <div class="ui grid">
                <div class="row">
                    <div class="column align center" style="text-align: center; font-size: 25px">Seus chamados</div>
                </div>
                <div class="row">
                    <div class="four wide column">
                        <div class="ui red card">
                            <div class="content">
                                <div class="center aligned header">Aberto</div>
                                <div class="center aligned description" style="padding: 50px 0px; font-size: 25px">
                                    {{$chamados->groupBy('status')->has(['aberto'])?$chamados->groupBy('status')['aberto']->count(): '0'}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="four wide column">
                        <div class="ui yellow card">
                            <div class="content">
                                <div class="center aligned header">Em andamento</div>
                                <div class="center aligned description" style="padding: 50px 0px; font-size: 25px">
                                    {{$chamados->groupBy('status')->has(['em andamento'])?$chamados->groupBy('status')['em andamento']->count(): '0'}}
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="four wide column">
                        <div class="ui green card">
                            <div class="content">
                                <div class="center aligned header">Fechado</div>
                                <div class="center aligned description" style="padding: 50px 0px; font-size: 25px">
                                    {{$chamados->groupBy('status')->has(['encerrado'])?$chamados->groupBy('status')['encerrado']->count(): '0'}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="four wide column">
                        <div class="ui black card">
                            <div class="content">
                                <div class="center aligned header">Reaberto</div>
                                <div class="center aligned description" style="padding: 50px 0px; font-size: 25px">
                                    {{$chamados->groupBy('status')->has(['reaberto'])?$chamados->groupBy('status')['reaberto']->count(): '0'}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="column align center" style="text-align: center; font-size: 25px">Chamados do seu setor</div>
                </div>
                <div class="row">
                    <div class="four wide column">
                        <div class="ui red card">
                            <div class="content">
                                <div class="center aligned header">Aberto</div>
                                <div class="center aligned description" style="padding: 50px 0px; font-size: 25px">
                                    {{
                                        $setor->groupBy('status')->has(['aberto'])?
                                            $setor->groupBy('status')['aberto']->count() : '0'
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="four wide column">
                        <div class="ui yellow card">
                            <div class="content">
                                <div class="center aligned header">Em andamento</div>
                                <div class="center aligned description" style="padding: 50px 0px; font-size: 25px">
                                    {{
                                       $setor->groupBy('status')->has(['em andamento'])?
                                            $setor->groupBy('status')['em andamento']->count() : '0'
                                    }}
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="four wide column">
                        <div class="ui green card">
                            <div class="content">
                                <div class="center aligned header">Fechado</div>
                                <div class="center aligned description" style="padding: 50px 0px; font-size: 25px">
                                    {{  
                                        $setor->groupBy('status')->has(['encerrado'])?
                                            $setor->groupBy('status')['encerrado']->count() : '0'
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="four wide column">
                        <div class="ui black card">
                            <div class="content">
                                <div class="center aligned header">Reaberto</div>
                                <div class="center aligned description" style="padding: 50px 0px; font-size: 25px">
                                    {{  
                                        $setor->groupBy('status')->has(['reaberto'])?
                                            $setor->groupBy('status')['reaberto']->count() : '0'
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* botao fechar do modal dentro do header */
        i.close.icon::before {
            cursor: pointer;
            position: absolute;
            font-size: 25px;
            color: gray;
            left: -30px;
            top: 45px;
        }
        @media(max-width: 600px) {
            i.close.icon::before {
                cursor: pointer;
                position: absolute;
                font-size: 25px;
                color: gray;
                left: -5px;
                top: 5px;
            }
        }
        /* div semi transparente para modal adicionada ao abrir o modal*/
        .ui.dimmer {
            padding: 0 !important;
        }
        /* retirada margem para que o modal fique contido dentro da tela 1366 por 720*/
        .modals.dimmer .ui.scrolling.modal {
            margin: 0.5rem auto;
        }
    </style>
    <div class="ui longer modal" id="modal">
    </div>
@endsection
