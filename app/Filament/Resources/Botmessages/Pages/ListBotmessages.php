<?php

namespace App\Filament\Resources\Botmessages\Pages;

use App\Filament\Resources\Botmessages\BotmessageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBotmessages extends ListRecords
{
    protected static string $resource = BotmessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
