<?php

namespace TglInova\Forms\Livewire\Components;

class SeguroCondominio extends FormularioBase
{
    public array $dados = ['cnpj' => null];

    public int $passo = 1;
    public int $ultimoPasso = 3;

    public function render()
    {
        return view('tglinova_forms::livewire.seguro-condominio');
    }
}
