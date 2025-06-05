<?php

namespace Tglinova\Forms\Filament\Presenters;

use Filament\Infolists\Components as Ic;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SeguroSaude implements Presenter
{
    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('dados.beneficiarios.*.nome')->badge()->label('Beneficiários'),
            TextColumn::make('dados.cnpj'),
            TextColumn::make('dados.plano_saude_atual')->label('Plano de Saude atual')
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Ic\RepeatableEntry::make('dados.beneficiarios')->columnSpanFull()->columns(2)->schema([
                Ic\TextEntry::make('nome'),
                Ic\TextEntry::make('data_nascimento')->placeholder('Não Informado')
            ])
        ]);
    }
}
