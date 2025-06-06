<?php

namespace TglInova\Forms\Livewire\Components;

class SeguroCondominio extends FormularioBase
{
    public array $dados = [
        'razao_social'           => null,
        'cnpj'                   => null,
        'quantidade_vagas'       => 0,
        'quantidade_blocos'      => 0,
        'idade_imovel'           => 0,
        'tem_cobertura_veiculos' => false,
        'quantidade_vagas' => null,
    ];

    public int $passo = 1;
    public int $ultimoPasso = 3;


    public function validacaoPasso(): array
    {
        return match ($this->passo) {
            1 => [
                'dados.razao_social'    => ['required', 'string'],
                'dados.cnpj'            => ['required', 'cnpj'],
                'dados.telefone'        => ['nullable', 'celular_com_ddd'],
                'dados.telefone_2'      => ['nullable', 'celular_com_ddd'],
                'dados.email'           => ['required', 'email'],
            ],

            2 => [
                'dados.endereco_cep'         => ['required'],
                'dados.endereco_logradouro'  => ['required', 'string'],
                'dados.endereco_numero'      => ['nullable'],
                'dados.endereco_complemento' => ['nullable'],
                'dados.endereco_bairro'      => ['required', 'string'],
            ],

            3 => [
                'dados.quantidade_vagas' => ['numeric'],
                'dados.quantidade_blocos' => ['numeric'],
                'dados.tem_cobertura_veiculos' => ['boolean'],
                'dados.idade_imovel'            => ['numeric']
            ]
        };
    }

    public function render()
    {
        return view('tglinova_forms::livewire.seguro-condominio');
    }
}
