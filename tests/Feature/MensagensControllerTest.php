<?php

namespace Tests\Feature;

use App\Models\Mensagens;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MensagensControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_nao_deve_conseguir_criar_mensagem_quando_nao_autenticado()
    {
        $mensagem = Mensagens::factory()->state(['mensagem'=>"aleatorio"])->forChamado()->create();

        $response = $this->post('/mensagens', ['mensagem'=>$mensagem->mensagem, "remetente_id"=>$mensagem->remetente_id ,'chamado_id'=>$mensagem->chamado_id]);

        $response->assertStatus(302);
    }

    public function test_deve_conseguir_criar_mensagem_quando_autenticado()
    {
        $mensagem = Mensagens::factory()->state(['mensagem'=>"aleatorio"])->forChamado()->create();

        $response = $this->be(User::factory()->create())->post('/mensagens', [
            'mensagem'=>$mensagem->mensagem, 
            "remetente_id"=>$mensagem->remetente_id,
            'chamado_id'=>$mensagem->chamado_id
        ]);

        $response->assertStatus(200);

    }
}
