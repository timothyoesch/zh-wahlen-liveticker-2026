<?php

namespace App\Filament\Resources\Srresults;

use App\Filament\Resources\Srresults\Pages\CreateSrresult;
use App\Filament\Resources\Srresults\Pages\EditSrresult;
use App\Filament\Resources\Srresults\Pages\ListSrresults;
use App\Filament\Resources\Srresults\Schemas\SrresultForm;
use App\Filament\Resources\Srresults\Tables\SrresultsTable;
use App\Models\Srresult;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SrresultResource extends Resource
{
    protected static ?string $model = Srresult::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SrresultForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SrresultsTable::configure($table);
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
            'index' => ListSrresults::route('/'),
            'create' => CreateSrresult::route('/create'),
            'edit' => EditSrresult::route('/{record}/edit'),
        ];
    }
}
