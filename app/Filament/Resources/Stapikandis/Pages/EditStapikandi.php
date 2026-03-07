<?php

namespace App\Filament\Resources\Stapikandis\Pages;

use App\Filament\Resources\Stapikandis\StapikandiResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStapikandi extends EditRecord
{
    protected static string $resource = StapikandiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
