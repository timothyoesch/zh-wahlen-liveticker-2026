<?php

namespace App\Filament\Resources\Stapiresults;

use App\Filament\Resources\Stapiresults\Pages\CreateStapiresult;
use App\Filament\Resources\Stapiresults\Pages\EditStapiresult;
use App\Filament\Resources\Stapiresults\Pages\ListStapiresults;
use App\Filament\Resources\Stapiresults\Pages\ViewStapiresult;
use App\Filament\Resources\Stapiresults\Schemas\StapiresultForm;
use App\Filament\Resources\Stapiresults\Schemas\StapiresultInfolist;
use App\Filament\Resources\Stapiresults\Tables\StapiresultsTable;
use App\Models\Stapiresult;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StapiresultResource extends Resource
{
    protected static ?string $model = Stapiresult::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return StapiresultForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StapiresultInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StapiresultsTable::configure($table);
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
            'index' => ListStapiresults::route('/'),
            'create' => CreateStapiresult::route('/create'),
            'view' => ViewStapiresult::route('/{record}'),
            'edit' => EditStapiresult::route('/{record}/edit'),
        ];
    }
}
