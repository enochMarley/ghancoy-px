<?php

namespace App\Filament\Resources\Expenses\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExpensesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable(),

                TextColumn::make('description')
                    ->words(3)
                    ->wrap()
                    ->searchable(),

                TextColumn::make('unit_cost_price')
                    ->label("Cost Price")
                    ->money('XAF')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('total_cost_price')
                    ->label('Total')
                    ->money('XAF')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime('d M y'),
            ])
            ->groups([
                Group::make('created_at')
                    ->orderQueryUsing(fn(Builder $query, string $direction) => $query->orderBy('created_at', 'desc'))
                    ->label("Date Recorded")
                    ->collapsible()
                    ->date(),
            ])
            ->defaultSort('id', 'desc')
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