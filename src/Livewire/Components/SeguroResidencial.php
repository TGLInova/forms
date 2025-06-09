<?php

namespace TglInova\Forms\Livewire\Components;

use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use TglInova\Forms\Enums\EstadoCivil;

class SeguroResidencial extends FormularioBase
{
    public array $dados = [
        'nome'                          => null,
        'email'                         => null,
        'celular'                       => null,
        'cpf'                           => null,
        'data_nascimento'               => null,
        'profissao'                     => null,
        'estado_civil'                  => null,
        'tem_sistema_protecao'          => false,
        'tem_escritorio'                => false,
        'tem_atividade_comercial'       => false,
        'atividade_comercial_descricao' => '',

        'endereco_cep'                  => null,
        'endereco_logradouro'           => null,
    ];

    public int $passo = 1;

    public int $ultimoPasso = 4;

    public function validacaoPasso(): array
    {
        return match ($this->passo) {
            1 => [
                'dados.nome'    => ['required', 'string', 'max:100'],
                'dados.email'   => ['required', 'string', 'email'],
                'dados.celular'  => ['required', 'celular_com_ddd'],
                'dados.telefone' => ['nullable', 'telefone_com_ddd'],
            ],
            2 => [
                'dados.cpf'              => ['nullable', 'cpf'],
                'dados.data_nascimento'  => ['required', 'date'],
                'dados.estado_civil'     => ['required', 'in:C,S,V,D'],
                'dados.profissao'       => ['required', 'string', 'max:50']
            ],
            3 => [
                'dados.endereco_cep'         => ['required'],
                'dados.endereco_logradouro'  => ['required', 'string'],
                'dados.endereco_numero'      => ['nullable'],
                'dados.endereco_complemento' => ['nullable'],
                'dados.endereco_bairro'      => ['required', 'string'],
            ],

            4 => [
                'dados.tem_sistema_protecao'          => ['required', 'boolean'],
                'dados.tem_escritorio'                => ['required', 'boolean'],
                'dados.tem_atividade_comercial'       => ['required', 'boolean'],
                'dados.atividade_comercial_descricao' => [
                    Rule::when($this->dados['tem_atividade_comercial'], ['required'], ['nullable']),
                    'string',
                    'max:255'
                ]
            ]
        };
    }

    public function render()
    {
        return view('tglinova_forms::livewire.seguro-residencial');
    }
}
