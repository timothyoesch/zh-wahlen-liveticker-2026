<?php

namespace App\Filament\Resources\Districts\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DistrictInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                IconEntry::make('done')
                    ->boolean(),
                IconEntry::make('donesr')
                    ->boolean(),
                IconEntry::make('donestapi')
                    ->boolean(),
            ]);
    }
}
