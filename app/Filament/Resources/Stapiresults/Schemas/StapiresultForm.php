<?php

namespace App\Filament\Resources\Stapiresults\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StapiresultForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('votes')
                    ->numeric()
                    ->default(null),
                TextInput::make('stapikandi_id')
                    ->required()
                    ->numeric(),
                TextInput::make('district_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
