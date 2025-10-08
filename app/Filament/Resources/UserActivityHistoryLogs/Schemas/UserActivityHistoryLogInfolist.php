<?php

namespace App\Filament\Resources\UserActivityHistoryLogs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserActivityHistoryLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('user.name')
                            ->numeric(),

                        TextEntry::make('details'),

                        TextEntry::make('created_at')
                            ->label("Logged At")
                            ->dateTime(),
                    ])
            ]);
    }
}
