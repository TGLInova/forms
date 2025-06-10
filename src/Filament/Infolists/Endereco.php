<?php
namespace TglInova\Forms\Filament\Infolists;

use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;

class Endereco
{
    public static function make()
    {
        return Fieldset::make('Endereço')->columns(['lg' => 4])->statePath('dados')->schema([
            TextEntry::make('endereco_logradouro')->label('Logradouro')->columnSpan(['lg' => 2]),
            TextEntry::make('endereco_numero')->label('Nº')->placeholder('Não Informado'),
            TextEntry::make('endereco_complemento')->label('Complemento')->placeholder('Não Informado'),
            TextEntry::make('endereco_bairro')->label('Bairro')->columns(['lg' => 2]),
            TextEntry::make('endereco_cidade')->label('Cidade'),
            TextEntry::make('endereco_cep')->label('CEP')
        ]);
    }
}
