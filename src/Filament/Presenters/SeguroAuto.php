<?php

namespace Tglinova\Forms\Filament\Presenters;

use Filament\Infolists\Infolist;
use Filament\Tables\Table;

class SeguroAuto implements Presenter
{
    public static function table(Table $table): Table
    {
        return $table;
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

        ]);
    }
}
