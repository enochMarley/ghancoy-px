<?php

namespace App\Filament\Resources\Sales\Schemas;

use App\Enum\SaleType;
use App\Models\Stock;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SaleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Select::make('stock_id')
                            ->relationship('stock', 'name')
                            ->preload()
                            ->searchable()
                            ->required()
                            ->visibleOn('create'),

                        Select::make('sale_type')
                            ->options(SaleType::class)
                            ->default(SaleType::CASH)
                            ->live()
                            ->required(),

                        Select::make('personnel_id')
                            ->relationship('personnel', 'service_number')
                            ->preload()
                            ->searchable()
                            ->required(fn($get) => $get('sale_type') == SaleType::CREDIT)
                            ->visible(fn($get) => $get('sale_type') == SaleType::CREDIT)
                            ->hiddenOn('edit'),

                        TextInput::make('quantity')
                            ->numeric()
                            ->minValue(1)
                            ->required()
                            ->rules([
                                function (callable $get) {
                                    return function (string $attribute, $value, \Closure $fail) use ($get) {
                                        $stockId = $get('stock_id');
                                        if ($stockId) {
                                            if ($value <= 0) {
                                                $fail("At least 1 quantity of the stock needs to be issued");
                                            }

                                            $stockQuantity = Stock::find($stockId)?->quantity ?? 0;
                                            if ($value > $stockQuantity) {
                                                $fail("Only {$stockQuantity} units are available.");
                                            }
                                        }
                                    };
                                },
                            ]),
                    ])
            ]);
    }
}