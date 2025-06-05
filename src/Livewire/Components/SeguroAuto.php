<?php

namespace TglInova\Forms\Livewire\Components;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use TglInova\Forms\Enums\EstadoCivil;

class SeguroAuto extends FormularioBase
{
    use WithFileUploads;

    public array $dados = ['nome' => '', 'cpf' => ''];
    public array $arquivos = ['anexo' => null];

    public int $passo = 1;

    public int $ultimoPasso = 5;

    public function validacaoPasso(): array
    {
        return match($this->passo) {
            1 => [
                'dados.nome'     => ['required', 'string', 'max:200'],
                'dados.cpf'      => ['required', 'cpf'],
                'dados.celular'  => ['nullable', 'celular_com_ddd'],
                'dados.telefone' => ['nullable', 'telefone_com_ddd']
            ],

            2 => [
                'dados.data_nascimento' => ['required', 'date'],
                'dados.estado_civil'    => [Rule::enum(EstadoCivil::class)]
            ],

            3 => [],

            4 => [],

            5 => [
                'dados.ano_fabricacao' => ['required']
            ]
        };
    }

    public function render()
    {
        return view('tglinova_forms::livewire.seguro-auto');
    }
}
