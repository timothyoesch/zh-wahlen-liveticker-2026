<?php

namespace App\Filament\Resources\Srkandis\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SrkandiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('identifier')
                    ->required(),
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('party')
                    ->required(),
            ]);
    }
}
