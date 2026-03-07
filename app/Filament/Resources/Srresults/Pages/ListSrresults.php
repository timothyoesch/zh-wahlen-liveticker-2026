<?php

namespace App\Filament\Resources\Srresults\Pages;

use App\Filament\Resources\Srresults\SrresultResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSrresults extends ListRecords
{
    protected static string $resource = SrresultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
