<?php

namespace App\Filament\Resources\Stapikandis\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StapikandiInfolist
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
                TextEntry::make('identifier'),
                TextEntry::make('first_name')
                    ->placeholder('-'),
                TextEntry::make('last_name'),
                TextEntry::make('party')
                    ->placeholder('-'),
            ]);
    }
}
