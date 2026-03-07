<?php

namespace App\Filament\Resources\Grkandis\Pages;

use App\Filament\Resources\Grkandis\GrkandiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGrkandis extends ListRecords
{
    protected static string $resource = GrkandiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
