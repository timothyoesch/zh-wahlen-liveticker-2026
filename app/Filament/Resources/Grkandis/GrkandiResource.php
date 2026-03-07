<?php

namespace App\Filament\Resources\Grkandis;

use App\Filament\Resources\Grkandis\Pages\CreateGrkandi;
use App\Filament\Resources\Grkandis\Pages\EditGrkandi;
use App\Filament\Resources\Grkandis\Pages\ListGrkandis;
use App\Filament\Resources\Grkandis\Schemas\GrkandiForm;
use App\Filament\Resources\Grkandis\Tables\GrkandisTable;
use App\Models\Grkandi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GrkandiResource extends Resource
{
    protected static ?string $model = Grkandi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'number';

    public static function form(Schema $schema): Schema
    {
        return GrkandiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GrkandisTable::configure($table);
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
            'index' => ListGrkandis::route('/'),
            'create' => CreateGrkandi::route('/create'),
            'edit' => EditGrkandi::route('/{record}/edit'),
        ];
    }
}
