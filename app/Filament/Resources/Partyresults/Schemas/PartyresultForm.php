<?php

namespace App\Filament\Resources\Partyresults\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PartyresultForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('party')
                    ->required(),
                TextInput::make('votes')
                    ->required()
                    ->numeric(),
                TextInput::make('electors')
                    ->required()
                    ->numeric(),
                TextInput::make('percentage')
                    ->required()
                    ->numeric(),
                TextInput::make('change')
                    ->required()
                    ->numeric(),
                Select::make('district_id')
                    ->relationship('district', 'name')
                    ->preload()
                    ->required(),
            ]);
    }
}
