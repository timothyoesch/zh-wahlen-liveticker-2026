<?php

namespace App\Filament\Resources\Srresults\Pages;

use App\Filament\Resources\Srresults\SrresultResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSrresult extends EditRecord
{
    protected static string $resource = SrresultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
