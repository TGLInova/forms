<?php

namespace TglInova\Forms\Filament\Resources\FormularioResource\Pages;

use App\Filament\Resources\FormularioQuestaoResource\Pages\EditFormularioQuestao;
use TglInova\Forms\Filament\Resources\FormularioResource;;
use Filament\Actions;
use Filament\Navigation\NavigationItem;
use Filament\Resources\Pages\EditRecord;

class EditFormulario extends EditRecord
{
    protected static string $resource = FormularioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
