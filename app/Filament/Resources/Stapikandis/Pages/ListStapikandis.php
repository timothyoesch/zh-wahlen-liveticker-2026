<?php

namespace App\Filament\Resources\Stapikandis\Pages;

use App\Filament\Resources\Stapikandis\StapikandiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStapikandis extends ListRecords
{
    protected static string $resource = StapikandiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
