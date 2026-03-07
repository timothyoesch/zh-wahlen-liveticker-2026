<?php

namespace App\Filament\Resources\Botmessages\Pages;

use App\Filament\Resources\Botmessages\BotmessageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBotmessage extends EditRecord
{
    protected static string $resource = BotmessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
