<?php

namespace App\Filament\Resources\Partyresults\Pages;

use App\Filament\Resources\Partyresults\PartyresultResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPartyresults extends ListRecords
{
    protected static string $resource = PartyresultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
