<?php

namespace App\Filament\Resources\Personnels\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PersonnelInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('service_number')
                            ->columnSpan(3),

                        TextEntry::make('rank.name')
                            ->label("Rank")
                            ->columnSpan(3),

                        TextEntry::make('last_name')
                            ->columnSpan(3),

                        TextEntry::make('other_names')
                            ->columnSpan(3),

                        TextEntry::make('gender')
                            ->columnSpan(3),

                        TextEntry::make('phone')
                            ->columnSpan(3),

                        TextEntry::make('email')
                            ->label('Email address')
                            ->columnSpan(3),
                    ])->columns(12)
            ])->columns(1);
    }
}
