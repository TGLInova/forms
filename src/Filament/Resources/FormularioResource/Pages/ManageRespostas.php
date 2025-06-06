<?php

namespace TglInova\Forms\Filament\Resources\FormularioResource\Pages;

use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Arr;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Components as Ic;
use Filament\Resources\Pages\ManageRelatedRecords;
use Illuminate\Contracts\Support\Htmlable;
use Tglinova\Forms\Filament\Resources\FormularioResource;
use TglInova\Forms\Models\Formulario;

class ManageRespostas extends ManageRelatedRecords
{
    protected static string $resource = FormularioResource::class;

    protected static string $relationship = 'respostas';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('visualizar_pagina')->label('Visualizar Página')->url(fn () => $this->record->url, true),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return "Respostas da ficha de " . $this->record->nome;
    }

    public function infolist(Infolist $infolist): Infolist
    {
        /**
         * @var Formulario
         */
        $formulario = $this->record;

        if ($formulario->apresentador) {
            return $formulario->apresentador::infolist($infolist);
        }

        return $infolist->schema(function ($record) {

            $schema = [];

            foreach (Arr::dot($record->dados) as $key) {
                $schema[] = Ic\TextEntry::make('dados.' . $key);
            }

            return $schema;
        });
    }

    public function table(Table $table): Table
    {
        $table
            ->recordTitleAttribute('dados.beneficiarios')
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('id')->label('Código'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()->slideOver()
            ]);

        if ($this->record->apresentador) {

            $this->record->apresentador::table($table);

            $table->pushColumns([
                TextColumn::make('created_at')->dateTime()->label('Data do Envio')->toggleable(isToggledHiddenByDefault: true)
            ]);

            return $table;
        }

        return $table;
    }
}
