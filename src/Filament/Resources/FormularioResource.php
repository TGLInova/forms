<?php

namespace TglInova\Forms\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components as Fc;
use Filament\Tables\Columns\TextColumn;
use TglInova\Forms\Models\Formulario;
use TglInova\Forms\Filament\Resources\FormularioResource\Pages;

class FormularioResource extends Resource
{
    protected static ?string $model = Formulario::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?int $navigationSort = 10;

    protected static ?string $modelLabel = 'Ficha de Cotação';

    protected static ?string $pluralModelLabel = 'Fichas de Cotação';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Fc\TextInput::make('nome')->required(),
                Fc\RichEditor::make('descricao')->label('Descrição')->columnSpanFull()->disableToolbarButtons(['attachFiles']),
                // Fc\Hidden::make('componente')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')->searchable(),
                TextColumn::make('respostas_count')->counts('respostas')->badge()->label('Fichas Preenchidas'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('visualizar_pagina')
                        ->label('Visualizar Página')
                        ->icon('heroicon-o-share')
                        ->url(fn($record) => $record->url, true),
                    Tables\Actions\Action::make('respostas')
                        ->icon('heroicon-o-numbered-list')
                        ->url(fn ($record) => Pages\ManageRespostas::getUrl(['record' => $record])),
                    Tables\Actions\EditAction::make(),
                ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormularios::route('/'),
            'create' => Pages\CreateFormulario::route('/create'),
            'edit' => Pages\EditFormulario::route('/{record}/edit'),
            'respostas' => Pages\ManageRespostas::route('{record}/respostas')
        ];
    }
}
