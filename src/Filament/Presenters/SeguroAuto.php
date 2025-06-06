<?php

namespace TglInova\Forms\Filament\Presenters;

use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SeguroAuto implements Presenter
{
    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('dados.nome')->label('Nome')
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            TextEntry::make('dados.nome')->label('Nome'),
            TextEntry::make('dados.email')->label('E-mail')->icon('heroicon-o-envelope'),
            TextEntry::make('dados.celular')->label('Celular'),
            TextEntry::make('dados.telefone')->label('Telefone'),
            TextEntry::make('dados.cpf')->label('CPF'),
            TextEntry::make('dados.data_nascimento')->date()->label('Data de Nascimento'),
            Fieldset::make('Informações do Veículo')->statePath('dados')->schema([
                TextEntry::make('ano_fabricacao')->label('Ano da Fabricação'),
                TextEntry::make('ano_modelo')->label('Ano do Modelo'),
                TextEntry::make('modelo')->label('Modelo'),
                TextEntry::make('placa')->label('Placa')
            ])
        ]);
    }
}
