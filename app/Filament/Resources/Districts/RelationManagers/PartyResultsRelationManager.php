<?php

namespace App\Filament\Resources\Districts\RelationManagers;

use App\Filament\Resources\Partyresults\PartyresultResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class PartyResultsRelationManager extends RelationManager
{
    protected static string $relationship = 'partyResults';

    protected static ?string $relatedResource = PartyresultResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
