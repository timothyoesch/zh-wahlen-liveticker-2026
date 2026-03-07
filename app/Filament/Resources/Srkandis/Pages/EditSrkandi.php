<?php

namespace App\Filament\Resources\Srkandis\Pages;

use App\Filament\Resources\Srkandis\SrkandiResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSrkandi extends EditRecord
{
    protected static string $resource = SrkandiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
