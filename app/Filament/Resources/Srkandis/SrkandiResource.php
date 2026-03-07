<?php

namespace App\Filament\Resources\Srkandis;

use App\Filament\Resources\Srkandis\Pages\CreateSrkandi;
use App\Filament\Resources\Srkandis\Pages\EditSrkandi;
use App\Filament\Resources\Srkandis\Pages\ListSrkandis;
use App\Filament\Resources\Srkandis\Pages\ViewSrkandi;
use App\Filament\Resources\Srkandis\Schemas\SrkandiForm;
use App\Filament\Resources\Srkandis\Schemas\SrkandiInfolist;
use App\Filament\Resources\Srkandis\Tables\SrkandisTable;
use App\Models\Srkandi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SrkandiResource extends Resource
{
    protected static ?string $model = Srkandi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'identifier';

    public static function form(Schema $schema): Schema
    {
        return SrkandiForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SrkandiInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SrkandisTable::configure($table);
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
            'index' => ListSrkandis::route('/'),
            'create' => CreateSrkandi::route('/create'),
            'view' => ViewSrkandi::route('/{record}'),
            'edit' => EditSrkandi::route('/{record}/edit'),
        ];
    }
}
