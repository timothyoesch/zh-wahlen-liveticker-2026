<?php

namespace App\Filament\Resources\Stapiresults\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StapiresultInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('votes')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('stapikandi_id')
                    ->numeric(),
                TextEntry::make('district_id')
                    ->numeric(),
            ]);
    }
}
