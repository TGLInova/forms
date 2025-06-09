<?php

namespace TglInova\Forms\Filament\Presenters;

use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use TglInova\Forms\Enums\EstadoCivil;
use TglInova\Forms\Filament\Infolists\Endereco;

class SeguroResidencial implements Presenter
{
    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('dados.nome')->label('Nome'),
            TextColumn::make('dados.email')->label('E-mail'),
            TextColumn::make('dados.celular')->label('Celular'),
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            TextEntry::make('dados.nome')->label('Nome'),
            TextEntry::make('dados.email')->label('E-mail')->icon('heroicon-o-envelope'),
            TextEntry::make('dados.celular')->label('Celular'),
            TextEntry::make('dados.telefone')->label('Telefone'),
            TextEntry::make('dados.cpf')->label('CPF')->placeholder('Não Informado'),
            TextEntry::make('dados.data_nascimento')->date()->label('Data de Nascimento'),
            TextEntry::make('dados.profissao')->label('Profissão'),
            TextEntry::make('dados.estado_civil')->label('Estado Civil')->formatStateUsing(fn ($state) => EstadoCivil::tryFrom($state)->getLabel()),

            Endereco::make()
        ]);
    }
}
