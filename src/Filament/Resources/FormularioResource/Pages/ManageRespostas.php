<?php

namespace Tglinova\Forms\Filament\Resources\FormularioResource\Pages;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components as Ic;
use Filament\Resources\Pages\ManageRelatedRecords;
use Tglinova\Forms\Filament\Resources\FormularioResource;

class ManageRespostas extends ManageRelatedRecords
{
    protected static string $resource = FormularioResource::class;

    protected static string $relationship = 'respostas';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(function ($record) {

            foreach ($record->dados as $key => $value) {
                $schema[$key] = Ic\TextEntry::make('dados.' . $key)->label($key);
            }

            return $schema;
        });
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('dados.nome')
            ->columns([
                Tables\Columns\TextColumn::make('dados.nome'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()
            ]);
    }
}
