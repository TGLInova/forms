<?php

namespace TglInova\Forms\Livewire\Components;

use Livewire\Attributes\Locked;
use Livewire\Component;
use TglInova\Forms\Models\Formulario;

abstract class FormularioBase extends Component
{
    public Formulario $formulario;

    public bool $sucesso = false;

    public int $passo = 1;

    public int $ultimoPasso = 1;

    public array $dados = [];

    public array $arquivos = [];

    protected function validacaoPasso(): array
    {
        return match($this->passo) {
            default => []
        };
    }

    public function proximoPasso()
    {
        $rules = $this->validacaoPasso($this->passo);

        filled($rules) && $this->validate($rules);

        if ($this->passo === $this->ultimoPasso) {
            $this->salvar();
        } else {
            $this->passo += 1;
        }
    }

    public function salvar()
    {
        $dados = $this->dados;

        foreach ($this->arquivos as $key => $arquivo) {
            $dados['arquivos'][$key] = $arquivo?->store('formularios');
        }

        $this->formulario->respostas()->create([
            'dados' => $dados
        ]);

        $this->sucesso = true;

        $this->reset('passo', 'dados', 'arquivos');
    }
}
