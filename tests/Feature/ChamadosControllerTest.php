<?php

namespace Tests\Feature;

use App\Models\Chamados;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ChamadosControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Teste para garantir que página não seja visualizada caso não esteja autenticado
     *
     * @return void
     */
    public function test_nao_deve_conseguir_acessar_quando_nao_autenticado()
    {
        $response = $this->get('/chamados');

        $response->assertRedirect('/entrar');
    }

    public function test_deve_conseguir_exibir_pagina_de_chamados()
    {

        $response = $this->be(User::factory()->create())->get('/chamados');

        $response->assertStatus(200);
    }

    public function test_nao_deve_conseguir_abrir_chamado_nao_estando_autenticado()
    {
        $chamado = Chamados::factory()
            ->hasSolicitante()
            ->hasSetor()
            ->hasCategoria()
            ->create();

        $response = $this->post('/chamados', [
            'solicitante_id'=> $chamado->solicitante_id,
            'setor_id' => $chamado->setor_id,
            'categoria_id' => $chamado->categoria_id,
            'localizacao_id' => $chamado->localizaco_id,
            'status' => $chamado->status,
            'mensagem' => "Valor qualquer"]);
        
        $response->assertStatus(302);
    }
}
