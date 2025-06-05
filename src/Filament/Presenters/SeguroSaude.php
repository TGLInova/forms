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
            TextColumn::make('dados.cnpj')->label('CNPJ')->placeholder('Não Informado'),
            TextColumn::make('dados.plano_saude_atual')->label('Plano de Saude atual')
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Ic\RepeatableEntry::make('dados.beneficiarios')
                ->label('Beneficiários')
                ->columnSpanFull()
                ->columns(2)
                ->schema([
                    Ic\TextEntry::make('nome'),
                    Ic\TextEntry::make('data_nascimento')->placeholder('Não Informado')->date()
                ]),
            Ic\TextEntry::make('dados.cnpj')->label('CNPJ')->placeholder('Não informado'),
            Ic\TextEntry::make('dados.preferencia')->label('Preferência Seguro Saúde'),
            Ic\TextEntry::make('dados.plano_amplitude')
                ->label('Plano Amplitude')
                ->formatStateUsing(fn($state) => ['N' => 'Nacional', 'R' => 'Regional'][$state] ?? null)->placeholder('Não Informado')
        ]);
    }
}
