<?php

namespace TglInova\Forms\Filament\Presenters;

use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SeguroCondominio implements Presenter
{
    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('dados.razao_social')->placeholder('Não informado')->label('CNPJ'),
            TextColumn::make('dados.cnpj')->placeholder('Não informado')->label('CNPJ')
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            TextEntry::make('dados.razao_social')->label('Razão Social'),
            TextEntry::make('dados.cnpj')->label('CNPJ'),
            Fieldset::make('Contato')->columns(3)->schema([
                TextEntry::make('dados.email')->label('E-mail')->icon('heroicon-o-envelope'),
                TextEntry::make('dados.celular')->label('Celular'),
                TextEntry::make('dados.telefone')->label('Telefone'),
            ]),
            Fieldset::make('Informações do Condomínio')->statePath('dados')->schema([
                TextEntry::make('unidades_por_bloco')->label('Unidade por Bloco'),
                TextEntry::make('quantidade_blocos')->label('Quantidade de Blocos'),
                TextEntry::make('vertical')->label('Posição'),
                IconEntry::make('tem_cobertura_veiculos')->label('Cobertura Para Veículos Estacionados?')->boolean(),
                TextEntry::make('quantidade_vagas')->label('Quantidade de Vagas'),
                TextEntry::make('valor_imovel')->money('BRL'),
                TextEntry::make('idade_imovel'),
            ]),


        ]);
    }
}
