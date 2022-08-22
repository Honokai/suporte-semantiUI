<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChamadoRespondidoEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $chamado;
    public int $solicitante;

    public function __construct(int $chamado, int $solicitante)
    {
        $this->chamado = $chamado;
        $this->solicitante = $solicitante;
    }

    public function broadcastOn()
    {
        return new Channel($this->solicitante);
    }

    public function broadcastWith()
    {
        return ['titulo' => "Chamado #{$this->chamado}", 'mensagem' => "Seu chamado foi respondido"];
    }

    public function broadcastAs()
    {
        return 'ChamadoRespondido';
    }
}
