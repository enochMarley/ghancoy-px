<?php

namespace App\Filament\Resources\StockHistories\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class StockHistoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('stock.name')
                    ->searchable(),

                TextColumn::make('previous_quantity')
                    ->label('Prev Qty')
                    ->placeholder('-'),

                TextColumn::make('added_quantity')
                    ->label('Added Qty')
                    ->placeholder('-'),

                TextColumn::make('new_quantity')
                    ->label('New Qty')
                    ->placeholder('-'),

                TextColumn::make('unit_cost_price')
                    ->label('Unit CP')
                    ->numeric()
                    ->money('XAF'),

                TextColumn::make('unit_selling_price')
                    ->label('Unit SP')
                    ->numeric()
                    ->money('XAF'),

                TextColumn::make('total_cost_price')

                    ->label('Total CP')
                    ->numeric()
                    ->money('XAF'),

                TextColumn::make('total_selling_price')
                    ->label('Total SP')
                    ->numeric()
                    ->money('XAF'),

                TextColumn::make('estimated_profit')
                    ->label('Estimated Profit')
                    ->numeric()
                    ->money('XAF'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->groups([
                Group::make('created_at')
                    ->orderQueryUsing(fn(Builder $query, string $direction) => $query->orderBy('created_at', 'desc'))
                    ->label("Added Date")
                    ->collapsible()
                    ->date(),
            ])
            ->defaultGroup('created_at', 'desc')
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
