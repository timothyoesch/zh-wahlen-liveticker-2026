<?php

namespace App\Filament\Resources\Botmessages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Schemas\Schema;

class BotmessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                MarkdownEditor::make('content')
                    ->required(),
                TextInput::make('message_id')
                    ->readOnly(),
                DateTimePicker::make('sent_at')
                    ->readOnly(),
            ])
            ->columns(1);
    }
}
