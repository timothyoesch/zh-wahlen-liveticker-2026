<?php

namespace App\Filament\Resources\Stapiresults\Pages;

use App\Filament\Resources\Stapiresults\StapiresultResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStapiresult extends EditRecord
{
    protected static string $resource = StapiresultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
