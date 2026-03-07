<?php

namespace App\Filament\Resources\Partyresults\Pages;

use App\Filament\Resources\Partyresults\PartyresultResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPartyresult extends EditRecord
{
    protected static string $resource = PartyresultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
