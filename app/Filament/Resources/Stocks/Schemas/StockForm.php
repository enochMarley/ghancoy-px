<?php

namespace App\Filament\Resources\Stocks\Schemas;

use App\Enum\StockCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StockForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->required(),

                        Textarea::make('description')
                            ->columnSpanFull(),

                        TextInput::make('unit_cost_price')
                            ->required()
                            ->numeric(),

                        TextInput::make('unit_selling_price')
                            ->required()
                            ->numeric(),

                        TextInput::make('quantity')
                            ->required()
                            ->numeric()
                            ->default(0),

                        Select::make('category')
                            ->options(StockCategory::class),
                    ])
            ]);
    }
}
