<?php

namespace TglInova\Forms\Filament\Presenters;

use Filament\Infolists\Components as Ic;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use TglInova\Forms\Enums\EstadoCivil;
use TglInova\Forms\Enums\TipoPessoa;
use TglInova\Forms\Filament\Infolists\Endereco;

class SeguroEmpresarial implements Presenter
{
    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('dados.nome')->label('Nome')->sortable(),
            TextColumn::make('dados.celular')->label('Celular'),
            TextColumn::make('dados.email')->label('E-mail'),
            TextColumn::make('dados.profissao')->label('Profissão/Ocupação')
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {

        return $infolist->schema([
            Ic\Fieldset::make('Dados Pessoais')->statePath('dados')->schema([
                Ic\TextEntry::make('nome')->label('Nome')->columnSpan(['lg' => 2]),
                Ic\TextEntry::make('data_nascimento')->label('Data de Nascimento')->placeholder('Não Informado')->date()->icon('heroicon-o-calendar'),
                Ic\TextEntry::make('tipo_pessoa')->label('Pessoa Física ou Jurídica?')->formatStateUsing(fn ($state) => TipoPessoa::tryFrom($state)?->getLabel()),
                Ic\TextEntry::make('cnpj')->label('CNPJ')->placeholder('Não Informado')->visible(fn ($record) => TipoPessoa::tryFrom($record->dados['tipo_pessoa']) === TipoPessoa::PESSOA_JURIDICA),
                Ic\TextEntry::make('cpf')->label('CPF')->placeholder('Não Informado')->visible(fn ($record) => TipoPessoa::tryFrom($record->dados['tipo_pessoa']) === TipoPessoa::PESSOA_FISICA),
                Ic\TextEntry::make('estado_civil')->label('Estado Civíl')->placeholder('Não Informado')
                    ->formatStateUsing(fn($state) => EstadoCivil::tryFrom($state)?->name),
            ])->columns(3),

            Ic\Fieldset::make('Informações de Contato')->statePath('dados')->schema([
                Ic\TextEntry::make('email')->label('E-mail')->icon('heroicon-o-envelope')->copyable(true),
                Ic\TextEntry::make('celular')->label('Celular')->icon('heroicon-o-device-phone-mobile'),
                Ic\TextEntry::make('telefone')->label('Telefone')->placeholder('Não Informado')->icon('heroicon-o-phone'),
            ])->columns(3),

            Endereco::make()->label('Endereço do Escritório'),

            Ic\Fieldset::make('Informações do Escritório')->statePath('dados')->schema([
                Ic\TextEntry::make('profissao')->label('Profissão')->placeholder('Não Informado'),
                Ic\TextEntry::make('imovel_proprio_ou_alugado')->label('Móvel próprio ou alugado?'),
                Ic\TextEntry::make('valor_reconstrucao_incendio')->money('BRL')->label('Valor em caso de incêndio'),
                Ic\TextEntry::make('valor_conteudo_local')->money('BRL')->label('Valor do Conteúdo Local'),
            ])->columns(3),

            Ic\Fieldset::make('Atividade')->statePath('dados')->schema([
                Ic\TextEntry::make('tem_atividade_local')->formatStateUsing(fn($state) => $state ? 'Sim' : 'Não')
                    ->badge()
                    ->label('Possui atividade no local?'),
                Ic\TextEntry::make('descricao_atividade_local')->label('Qual é atividade local?')
                    ->visible(fn($record) => $record->dados['descricao_atividade_local'] ?? null),
            ])
        ]);
    }
}
