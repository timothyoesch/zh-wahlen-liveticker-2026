<?php

namespace App\Filament\Resources\Botmessages;

use App\Filament\Resources\Botmessages\Pages\CreateBotmessage;
use App\Filament\Resources\Botmessages\Pages\EditBotmessage;
use App\Filament\Resources\Botmessages\Pages\ListBotmessages;
use App\Filament\Resources\Botmessages\Schemas\BotmessageForm;
use App\Filament\Resources\Botmessages\Tables\BotmessagesTable;
use App\Models\Botmessage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BotmessageResource extends Resource
{
    protected static ?string $model = Botmessage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Envelope;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return BotmessageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BotmessagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBotmessages::route('/'),
            'create' => CreateBotmessage::route('/create'),
            'edit' => EditBotmessage::route('/{record}/edit'),
        ];
    }
}
