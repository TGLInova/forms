<?php

namespace TglInova\Forms\Seeders;

use Illuminate\Database\Seeder;
use TglInova\Forms\Models\Formulario;

class FormularioSeeder extends Seeder
{
    public function run(): void
    {
        $formularios = [
            1 => [
                'nome' => 'Seguro Auto',
                'descricao' => "Dirija com Tranquilidade e Segurança.\n\nAtravés deste formulário online, você poderá solicitar a sua cotação de seguro de forma rápida e segura, sem precisar se deslocar até o nosso escritório. Preencha todos os campos com atenção e informe os dados do seu veículo e seus dados pessoais.",
                'componente' => \TglInova\Forms\Livewire\Components\SeguroAuto::class,
                'apresentador' => \TglInova\Forms\Filament\Presenters\SeguroAuto::class,
            ],
            2 => [
                'nome' => 'Seguro Saúde',
                'descricao' => <<<HTML
                    Para garantir uma conversa mais direta e alinhada com o que você realmente precisa, pedimos que preencha este formulário com algumas informações básicas sobre os beneficiários que farão parte da proposta.\n\nEssas informações permitirão que nossa especialista compreenda melhor o seu perfil e indique as opções de seguro saúde mais compatíveis com sua realidade e expectativas.\n\nSinta-se à vontade para responder com calma. Todos os dados serão mantidos em sigilo absoluto e utilizados apenas para fins de atendimento personalizado.
                HTML,
                'componente' => \TglInova\Forms\Livewire\Components\SeguroSaude::class,
                'apresentador' => \TglInova\Forms\Filament\Presenters\SeguroSaude::class,
                // 'apresentador' =>
            ],

            3 => [
                'nome' => 'Seguro Condomínio',
                'descricao' => <<<HTML
                    <p>Proteja o Seu Lar e o Seu Patrimônio</p>
                    <p>
                    Através deste formulário online, você poderá solicitar a sua cotação de seguro de forma rápida e segura, sem precisar se deslocar até o nosso escritório. Preencha todos os campos com atenção e informe os dados do seu condomínio.</p>
                HTML,
                'componente' => \TglInova\Forms\Livewire\Components\SeguroCondominio::class,
                'apresentador' => \TglInova\Forms\Filament\Presenters\SeguroCondominio::class
            ],

            4 => [
                'nome' => 'Seguro Residencial',
                'descricao' => <<<HTML
                    <p>
                        Você está pronto para proteger o seu lar com o Seguro Residencial?
                    </p>
                    <p>
                        Através deste formulário online, você poderá solicitar a sua cotação de seguro de forma rápida e segura, sem
                        precisar se deslocar até o nosso escritório. Preencha todos os campos com atenção e informe os dados do seu
                        imóvel e seus bens.
                    </p>
                HTML,
                'componente' => \TglInova\Forms\Livewire\Components\SeguroResidencial::class,
                'apresentador' => \TglInova\Forms\Filament\Presenters\SeguroResidencial::class
            ],

            5 => [
                'nome' => 'Seguro Viagem',
                'descricao' => <<<HTML
                    <p>Através deste formulário online, você poderá solicitar a sua cotação de seguro de forma rápida e segura, sem precisar se deslocar até o nosso escritório. Preencha todos os campos com atenção e informe os dados da sua viagem e seus dados pessoais.</p>
                HTML,
                'componente'   => \TglInova\Forms\Livewire\Components\SeguroViagem::class,
                'apresentador' => \TglInova\Forms\Filament\Presenters\SeguroViagem::class
            ]
        ];

        foreach ($formularios as $id => $item) {
            Formulario::withTrashed()->firstOrNew(['id' => $id])->fill($item)->save();
        }
    }
}
