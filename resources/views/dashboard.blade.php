@extends('templates.layout', ['titulo'=>"Visão geral"])
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
                                        $chamados->groupBy('setor_id')->has([Auth::user()->setor_id]) &&
                                        $chamados->groupBy('setor_id')[Auth::user()->setor_id]->groupBy('status')->has(['aberto'])?
                                            $chamados->groupBy('setor_id')[Auth::user()->setor_id]->groupBy('status')['aberto']->count() : 
                                            '0'
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
                                        $chamados->groupBy('setor_id')->has([Auth::user()->setor_id]) &&
                                        $chamados->groupBy('setor_id')[Auth::user()->setor_id]->groupBy('status')->has(['em andamento'])?
                                            $chamados->groupBy('setor_id')[Auth::user()->setor_id]->groupBy('status')['em andamento']->count() : 
                                            '0'
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
                                        $chamados->groupBy('setor_id')->has([Auth::user()->setor_id]) &&
                                        $chamados->groupBy('setor_id')[Auth::user()->setor_id]->groupBy('status')->has(['encerrado'])?
                                            $chamados->groupBy('setor_id')[Auth::user()->setor_id]->groupBy('status')['encerrado']->count() : 
                                            '0'
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
                                        $chamados->groupBy('setor_id')->has([Auth::user()->setor_id]) &&
                                        $chamados->groupBy('setor_id')[Auth::user()->setor_id]->groupBy('status')->has(['reaberto'])?
                                            $chamados->groupBy('setor_id')[Auth::user()->setor_id]->groupBy('status')['reaberto']->count() : 
                                            '0'
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection
