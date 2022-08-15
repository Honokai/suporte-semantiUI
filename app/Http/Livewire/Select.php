<?php

namespace App\Http\Livewire;

use App\Models\Subcategoria;
use Livewire\Component;

class Select extends Component
{
    public $subcategorias;
    public $selected;
    public $mostrarAdicional;
    protected $listeners = ['refresh' => '$refresh'];

    public function render()
    {
        return view('livewire.select')->with('selected', $this->selected)->with('mostrarAdicional', $this->mostrarAdicional);
    }

    public function selectComplementar(Subcategoria $subcategoria)
    {
        $this->selected = $subcategoria?->id ?? null;
        $this->mostrarAdicional = $subcategoria->categoria->setor->nome ?? null;
        $this->subcategorias = Subcategoria::all();
    }
}
