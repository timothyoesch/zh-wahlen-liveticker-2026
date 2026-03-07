<?php

namespace App\Filament\Resources\Srkandis\Pages;

use App\Filament\Resources\Srkandis\SrkandiResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSrkandi extends ViewRecord
{
    protected static string $resource = SrkandiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
