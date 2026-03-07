<?php

namespace App\Filament\Resources\Stapiresults\Pages;

use App\Filament\Resources\Stapiresults\StapiresultResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStapiresult extends ViewRecord
{
    protected static string $resource = StapiresultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
