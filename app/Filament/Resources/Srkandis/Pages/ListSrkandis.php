<?php

namespace App\Filament\Resources\Srkandis\Pages;

use App\Filament\Resources\Srkandis\SrkandiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSrkandis extends ListRecords
{
    protected static string $resource = SrkandiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
