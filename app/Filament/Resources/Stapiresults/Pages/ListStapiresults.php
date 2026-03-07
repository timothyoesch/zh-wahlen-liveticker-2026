<?php

namespace App\Filament\Resources\Stapiresults\Pages;

use App\Filament\Resources\Stapiresults\StapiresultResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStapiresults extends ListRecords
{
    protected static string $resource = StapiresultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
