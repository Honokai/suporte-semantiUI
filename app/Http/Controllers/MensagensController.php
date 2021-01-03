<?php

namespace App\Http\Controllers;

use App\Enums\StatusTipo;
use App\Models\Anexos;
use App\Models\Chamados;
use App\Models\Mensagens;
use App\Models\User;
use Illuminate\Http\Request;

class MensagensController extends Controller
{
    /**
     * @param Request $request
     * @return View mensagem
     */
    public function store(Request $request)
    {
        $novaMensagem = new Mensagens;
        $novaMensagem->mensagem = $request->mensagem;
        $novaMensagem->chamado_id = $request->chamado_id;
        $novaMensagem->remetente_id = $request->remetente_id;
        if($novaMensagem->make()) {
            $chamado = Chamados::find($request->chamado_id);
            $usuario = User::find($request->remetente_id);
            $chamado->updated_at = date('Y-m-d H:i:s');
            # caso o chamado ainda não tenha sido atendido, então colocará o mesmo em estado de em andamento
            if($chamado->status == "aberto" && $usuario->setor->id == $chamado->setor_id) {
                $chamado->status = StatusTipo::ANDAMENTO;
            }
            # mensagem pode ter anexo, caso tenha irá inserir no banco
            if($request->hasFile('anexos')) {
                $anexo = new Anexos;
                foreach($request->file('anexos') as $arquivo) {
                    # armazena o arquivo em si e salva o caminho
                    # em uma variavel para armazenamento no banco
                    $caminho = $arquivo->store("\\anexos\\{$chamado->id}", ['disk' => 'public']);
                    if($caminho) {
                        $anexo->anexo = str_replace('/','\\', $caminho);
                        $anexo->chamados_id = $chamado->id;
                        $anexo->save();
                    }
                }
            }
            # verifica se foi possivel atualizar as informações de chamado
            # se sim salva a mensagem.
            if($chamado->update()) {
                $novaMensagem->save();
            }
        }
        return view('mensagem')->with('mensagem', $novaMensagem);
    }
}
