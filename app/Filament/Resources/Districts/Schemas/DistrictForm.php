<?php

namespace App\Filament\Resources\Districts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DistrictForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Toggle::make('done')
                    ->required(),
                Toggle::make('donesr')
                    ->required(),
                Toggle::make('donestapi')
                    ->required(),
            ]);
    }
}
