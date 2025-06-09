<?php

namespace TglInova\Forms\Filament\Resources\FormularioResource\Pages;

use TglInova\Forms\Filament\Resources\FormularioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormularios extends ListRecords
{
    protected static string $resource = FormularioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
