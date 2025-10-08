<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('name'),

                        TextEntry::make('email')
                            ->label('Email address'),

                        TextEntry::make('phone')
                            ->placeholder('-'),

                        TextEntry::make('email_verified_at')
                            ->dateTime()
                            ->placeholder('-'),

                        TextEntry::make('role')
                            ->badge(),

                        IconEntry::make('status')
                            ->boolean(),

                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                    ])
            ]);
    }
}
