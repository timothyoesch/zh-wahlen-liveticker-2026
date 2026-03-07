<?php

namespace App\Filament\Resources\Stapikandis\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StapikandiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('identifier')
                    ->required(),
                TextInput::make('first_name')
                    ->default(null),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('party')
                    ->default(null),
            ]);
    }
}
