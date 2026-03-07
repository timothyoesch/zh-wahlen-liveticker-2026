<?php

namespace App\Filament\Resources\Srresults\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SrresultForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('votes')
                    ->numeric()
                    ->default(null),
                TextInput::make('srkandi_id')
                    ->required()
                    ->numeric(),
                TextInput::make('district_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
