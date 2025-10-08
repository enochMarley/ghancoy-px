<?php

namespace App\Filament\Resources\Stocks\Tables;

use App\Models\Stock;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StocksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('quantity', 'asc')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('quantity_with_label')
                    ->label('Quantity')
                    ->numeric(),

                TextColumn::make('unit_cost_price')
                    ->numeric()
                    ->money('XAF'),

                TextColumn::make('unit_selling_price')
                    ->numeric()
                    ->money('XAF'),

                TextColumn::make('total_cost_price')
                    ->label('Total Cost Price')
                    ->numeric()
                    ->money('XAF'),

                TextColumn::make('total_selling_price')
                    ->label('Total Selling Price')
                    ->numeric()
                    ->money('XAF'),

                TextColumn::make('estimated_profit')
                    ->label('Estimated Profit')
                    ->numeric()
                    ->money('XAF'),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
