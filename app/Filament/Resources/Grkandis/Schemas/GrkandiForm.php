<?php

namespace App\Filament\Resources\Grkandis\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GrkandiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('number')
                    ->required(),
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('party')
                    ->required(),
                Toggle::make('incumbent')
                    ->required(),
                TextInput::make('votes')
                    ->numeric()
                    ->default(null),
                TextInput::make('ranking')
                    ->numeric()
                    ->default(null),
                TextInput::make('district_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
