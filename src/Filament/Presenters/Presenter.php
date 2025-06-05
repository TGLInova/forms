<?php
namespace Tglinova\Forms\Filament\Presenters;

use Filament\Infolists\Infolist;
use Filament\Tables\Table;

interface Presenter
{
    public static function infolist(Infolist $infolist): Infolist;
    public static function table(Table $table): Table;
}
