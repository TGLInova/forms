<?php

namespace TglInova\Forms\Filament\Presenters;

use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SeguroViagem implements Presenter
{
    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('dados.nome')->label('Nome'),
            TextColumn::make('dados.email')->label('E-mail')->icon('heroicon-o-envelope'),
            TextColumn::make('dados.celular')->icon('heroicon-o-device-phone-mobile')->label('Celular'),
            TextColumn::make('dados.origem_viagem')->label('Origem'),
            TextColumn::make('dados.destino_viagem')->label('Destino')
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->columns(3)->schema([
            TextEntry::make('dados.nome'),
            TextEntry::make('dados.email'),
            TextEntry::make('dados.celular'),
            Fieldset::make('Dados da Viagem')->schema([
                TextEntry::make('dados.origem_viagem')->label('Origem'),
                TextEntry::make('dados.destino_viagem')->label('Destino'),
            ]),
            RepeatableEntry::make('dados.passageiros')->columns(3)->columnSpanFull()->schema([
                TextEntry::make('nome')->columnSpan(2),
                TextEntry::make('idade')
            ])
        ]);
    }
}
