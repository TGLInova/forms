<?php

namespace Tglinova\Forms\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components as Fc;
use TglInova\Forms\Models\Formulario;
use Tglinova\Forms\Filament\Resources\FormularioResource\Pages;

class FormularioResource extends Resource
{
    protected static ?string $model = Formulario::class;

    protected static ?string $navigationIcon = 'heroicon-o-numbered-list';

    protected static ?int $navigationSort = 10;

    protected static ?string $modelLabel = 'Fichas';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Fc\TextInput::make('nome')->required(),
                Fc\Textarea::make('descricao')->label('Descrição')->columnSpanFull(),
                // Fc\Hidden::make('componente')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('respostas')
                    ->icon('heroicon-o-numbered-list')
                    ->url(fn ($record) => Pages\ManageRespostas::getUrl(['record' => $record])),
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
