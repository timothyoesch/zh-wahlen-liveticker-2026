<?php

namespace App\Filament\Resources\Grkandis\Pages;

use App\Filament\Resources\Grkandis\GrkandiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGrkandi extends EditRecord
{
    protected static string $resource = GrkandiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
