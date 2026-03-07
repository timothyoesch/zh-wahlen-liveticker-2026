<?php

namespace App\Filament\Resources\Stapikandis;

use App\Filament\Resources\Stapikandis\Pages\CreateStapikandi;
use App\Filament\Resources\Stapikandis\Pages\EditStapikandi;
use App\Filament\Resources\Stapikandis\Pages\ListStapikandis;
use App\Filament\Resources\Stapikandis\Pages\ViewStapikandi;
use App\Filament\Resources\Stapikandis\Schemas\StapikandiForm;
use App\Filament\Resources\Stapikandis\Schemas\StapikandiInfolist;
use App\Filament\Resources\Stapikandis\Tables\StapikandisTable;
use App\Models\Stapikandi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StapikandiResource extends Resource
{
    protected static ?string $model = Stapikandi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return StapikandiForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StapikandiInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StapikandisTable::configure($table);
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
            'index' => ListStapikandis::route('/'),
            'create' => CreateStapikandi::route('/create'),
            'view' => ViewStapikandi::route('/{record}'),
            'edit' => EditStapikandi::route('/{record}/edit'),
        ];
    }
}
