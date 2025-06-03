<?php

namespace TglInova\Forms\Seeders;

use Illuminate\Database\Seeder;
use TglInova\Forms\Models\Formulario;

class FormularioSeeder extends Seeder
{
    public function run(): void
    {
        $formularios = [
            1 => ['nome' => 'Seguro Auto', 'componente' => 'components.formularios.seguro-auto'],
            2 => ['nome' => 'Seguro de Vida', 'componente' => 'components.formularios.seguro-vida'],
        ];

        foreach ($formularios as $id => $item) {
            Formulario::firstOrNew(['id' => $id])->fill($item)->save();
        }
    }
}
