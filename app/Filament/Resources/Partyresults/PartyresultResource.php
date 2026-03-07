<?php

namespace App\Filament\Resources\Partyresults;

use App\Filament\Resources\Partyresults\Pages\CreatePartyresult;
use App\Filament\Resources\Partyresults\Pages\EditPartyresult;
use App\Filament\Resources\Partyresults\Pages\ListPartyresults;
use App\Filament\Resources\Partyresults\Schemas\PartyresultForm;
use App\Filament\Resources\Partyresults\Tables\PartyresultsTable;
use App\Models\Partyresult;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PartyresultResource extends Resource
{
    protected static ?string $model = Partyresult::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'party';

    public static function form(Schema $schema): Schema
    {
        return PartyresultForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PartyresultsTable::configure($table);
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
            'index' => ListPartyresults::route('/'),
            'create' => CreatePartyresult::route('/create'),
            'edit' => EditPartyresult::route('/{record}/edit'),
        ];
    }
}
