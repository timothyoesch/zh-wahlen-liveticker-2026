<?php

namespace App\Filament\Resources\Stapikandis\Pages;

use App\Filament\Resources\Stapikandis\StapikandiResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStapikandi extends ViewRecord
{
    protected static string $resource = StapikandiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
