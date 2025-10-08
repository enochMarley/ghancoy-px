<?php

namespace App\Filament\Resources\Sales\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SaleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('stock.name')
                            ->label('Stock'),
                        TextEntry::make('personnel.id')
                            ->label('Personnel')
                            ->placeholder('-'),
                        TextEntry::make('quantity')
                            ->numeric(),
                        TextEntry::make('sale_type')
                            ->badge(),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                    ])
            ]);
    }
}
