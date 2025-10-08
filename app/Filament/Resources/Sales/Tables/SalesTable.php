<?php

namespace App\Filament\Resources\Sales\Tables;

use App\Enum\SaleType;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SalesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('stock.name')
                    ->searchable(['name']),

                TextColumn::make('personnel.name_with_rank')
                    ->placeholder('-')
                    ->searchable(['last_name', 'other_names']),

                TextColumn::make('quantity')
                    ->numeric(),

                TextColumn::make('stock.unit_selling_price')
                    ->numeric()
                    ->label('Unit SP')
                    ->money('XAF'),

                TextColumn::make('total_amount')
                    ->numeric()
                    ->label('Total Amount')
                    ->money('XAF'),

                TextColumn::make('created_at')
                    ->label("Sales Date")
                    ->dateTime('d M y, hi')
                    ->suffix(' hrs'),
            ])
            ->groups([
                Group::make('created_at')
                    ->orderQueryUsing(fn(Builder $query, string $direction) => $query->orderBy('created_at', 'desc'))
                    ->label("Sales Date")
                    ->collapsible()
                    ->date(), // groups by day
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
