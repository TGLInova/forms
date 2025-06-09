<?php

namespace TglInova\Forms\Livewire\Components;

use Illuminate\Validation\Rule;

class SeguroViagem extends FormularioBase
{
    public array $dados = [
        'nome' => '',
        'email' => '',
        'celular' => '',
        'telefone' => null,
        'cpf'      => null,
        'passageiros' => [
            ['nome' => null, 'idade' => null]
        ]
    ];

    public int $passo = 1;

    public int $ultimoPasso = 3;

    public function validacaoPasso(): array
    {
        return match ($this->passo) {
            1 => [
                'dados.nome'    => ['required', 'string', 'max:100'],
                'dados.email'   => ['required', 'string', 'email'],
                'dados.celular'  => ['required', 'celular_com_ddd'],
                'dados.telefone' => ['nullable', 'telefone_com_ddd'],
                'dados.cpf'              => ['nullable', 'cpf'],
                'dados.data_nascimento'  => ['required', 'date'],
            ],
            2 => [
                'dados.origem_viagem'     => ['required', 'string'],
                'dados.destino_viagem'    => ['required', 'string']
            ],
            3 => [
                'dados.passageiros.*.nome' => ['required', 'string', 'max:100'],
                'dados.passageiros.*.idade'  => ['required', 'integer', 'min:0', 'max:130']
            ],
        };
    }

    public function render()
    {
        return view('tglinova_forms::livewire.seguro-viagem');
    }

    public function adicionarPassageiro()
    {
        $this->dados['passageiros'][] = ['name' => null, 'age' => null];
    }

    public function removerPassageiro(int $key)
    {
        unset($this->dados['passageiros'][$key]);
    }
}
