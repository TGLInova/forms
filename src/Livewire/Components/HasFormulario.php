<?php

namespace TglInova\Forms\Livewire\Components;


use TglInova\Forms\Models\Formulario;

trait HasFormulario
{
    public Formulario $formulario;

    public $sucesso = false;

    protected function getRuleFromStep(int $step): ?array
    {
        return null;
    }

    public function proximoPasso()
    {
        $rules = $this->getRuleFromStep($this->passo);

        is_array($rules) && count($rules) > 0 && $this->validate($rules);

        if ($this->passo === $this->ultimoPasso) {
            $this->salvar();
        } else {
            $this->passo += 1;
        }
    }

    public function salvar()
    {
        $dados = $this->dados;

        if (property_exists($this, 'arquivos')) {
            foreach ($this->arquivos as $key => $arquivo) {
                $dados['arquivos'][$key] = $arquivo?->store('formularios');
            }
        }

        $this->formulario->respostas()->create([
            'dados' => $dados
        ]);

        $this->sucesso = true;

        if (property_exists($this, 'passo')) {
            $this->reset('passo', 'dados', 'arquivos');
        }
    }
}
