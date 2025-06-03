<?php

namespace TglInova\Forms\Livewire\Components;

use Livewire\Component;

class SeguroAuto extends Component
{
    use HasFormulario;

    public array $dados = ['nome' => '', 'cpf' => ''];

    public $passo = 2;

    public function submit()
    {
        $this->salvar();
    }

    public function render()
    {
        return view('tglinova_forms::livewire.seguro-auto');
    }
}
