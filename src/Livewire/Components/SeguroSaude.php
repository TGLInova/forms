<?php

namespace TglInova\Forms\Livewire\Components;

class SeguroSaude extends FormularioBase
{
    public int $passo = 1;

    public int $ultimoPasso = 3;

    public array $dados = [
        'beneficiarios' => [
            []
        ]
    ];

    public function render()
    {
        return view('tglinova_forms::livewire.seguro-saude');
    }

    public function removerBeneficiario(int $key)
    {
        if (count($this->dados['beneficiarios']) <= 1) {
            $this->addError('holders', 'É obrigatório informar pelo menos 1 beneficiário.');
            return;
        }

        unset($this->dados['beneficiarios'][$key]);
    }

    public function adicionarBeneficiario()
    {
        $this->dados['beneficiarios'][] = ['nome' => null, 'data_nascimento' => null];
    }
}
