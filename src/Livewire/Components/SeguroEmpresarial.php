<?php

namespace TglInova\Forms\Livewire\Components;

class SeguroEmpresarial extends FormularioBase
{
    public array $dados = [
        'nome'        => null,
        'cpf'         => null,
        'cnpj'        => null,
        'tipo_pessoa' => 'F',
        'telefone'    => null,
        'celular'     => null,

    ];

    public int $passo = 1;

    public int $ultimoPasso = 3;

    public function validacaoPasso(): array
    {
        return match ($this->passo) {
            1 => [
                'dados.nome'        => ['required', 'string', 'max:100'],
                'dados.cpf'         => ['nullable', 'cpf'],
                'dados.cnpj'        => ['nullable', 'cnpj'],
                'dados.email'       => ['required', 'string', 'email'],
                'dados.celular'     => ['required', 'celular_com_ddd'],
                'dados.telefone'    => ['nullable', 'celular_com_ddd'],
            ],
            2 => [
                'dados.data_nascimento'            => ['required', 'date'],
                'dados.estado_civil'   => ['required', 'in:C,S,V,D'],
                'dados.profissao'       => ['required', 'string', 'max:50'],
            ],
            3 => [
                'dados.endereco_cep'                => ['required'],
                'dados.endereco_logradouro'         => ['required', 'string'],
                'dados.endereco_numero'             => ['nullable'],
                'dados.endereco_complemento'        => ['nullable'],
                'dados.endereco_bairro'             => ['required', 'string'],

                'dados.imovel_proprio_ou_alugado'   => ['required', 'in: Próprio,Alugado'],
                'dados.valor_reconstrucao_incendio' => ['required', 'numeric'],
                'dados.valor_conteudo_local'        => ['required', 'numeric'],
                'dados.tem_atividade_local'         => ['required', 'boolean'],
                'dados.descricao_atividade_local'   => ['required_if:dados.tem_atividade_local,true', 'string']
            ],
            default => []
        };
    }

    public function render()
    {
        return view('tglinova_forms::livewire.seguro-empresarial');
    }
}
