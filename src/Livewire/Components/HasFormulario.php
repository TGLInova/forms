<?php

namespace TglInova\Forms\Livewire\Components;

use TglInova\Forms\Models\Formulario;

trait HasFormulario
{
    public Formulario $formulario;

    protected function getRuleFromStep(int $step): array
    {
        return $this->groupedRules()[$step];
    }

    protected function groupedRules(): array
    {
        return [
            1 => [
                'dados.nome'    => ['required', 'string', 'max:200'],
                'dados.cpf'     => ['required', 'cpf'],
                'dados.celular' => ['nullable', 'celular_com_ddd'],
                'dados.telefone' => ['nullable', 'telefone_com_ddd']
            ],

            2 => [

            ]
        ];
    }

    public function proximoPasso()
    {
        $rules = $this->getRuleFromStep($this->passo);

        // dd($this->dados);

        $this->validate($rules);

        $this->passo += 1;
    }

    public function salvar()
    {
        $this->formulario->respostas()->create([
            'dados' => $this->dados
        ]);
    }
}
