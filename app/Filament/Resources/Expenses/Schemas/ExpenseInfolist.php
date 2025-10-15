<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExpenseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('User'),

                        TextEntry::make('description'),
                        TextEntry::make('unit_cost_price')
                            ->prefix('FCFA ')
                            ->numeric(),

                        TextEntry::make('quantity')
                            ->numeric(),

                        TextEntry::make('total_cost_price')
                            ->label('Total')
                            ->prefix('FCFA ')
                            ->numeric(),

                        TextEntry::make('created_at')
                            ->dateTime('d M y')
                            ->placeholder('-'),

                        TextEntry::make('updated_at')
                            ->dateTime('d M y')
                            ->placeholder('-'),
                    ])
            ]);
    }
}