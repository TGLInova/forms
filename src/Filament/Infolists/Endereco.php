<?php
namespace TglInova\Forms\Filament\Infolists;

use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;

class Endereco
{
    public static function make()
    {
        return Fieldset::make('Endereço')->columns(3)->statePath('dados')->schema([
            TextEntry::make('endereco_logradouro')->label('Logradouro')->columnSpan(2),
            TextEntry::make('endereco_numero')->label('Nº'),
            TextEntry::make('endereco_complemento')->label('Complemento')->placeholder('Não Informado'),
            TextEntry::make('endereco_bairro')->label('Bairro'),
            TextEntry::make('endereco_cidade')->label('Cidade'),
            TextEntry::make('endereco_cep')->label('CEP')
        ]);
    }
}
