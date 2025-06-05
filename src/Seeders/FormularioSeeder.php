<?php

namespace TglInova\Forms\Seeders;

use Illuminate\Database\Seeder;
use TglInova\Forms\Livewire\Components\SeguroAuto;
use TglInova\Forms\Livewire\Components\SeguroVida;
use TglInova\Forms\Models\Formulario;

class FormularioSeeder extends Seeder
{
    public function run(): void
    {
        $formularios = [
            1 => ['nome' => 'Seguro Auto', 'componente' => SeguroAuto::class],
            2 => ['nome' => 'Seguro de Vida', 'componente' => SeguroVida::class],
        ];

        foreach ($formularios as $id => $item) {
            Formulario::firstOrNew(['id' => $id])->fill($item)->save();
        }
    }
}
