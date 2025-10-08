<?php

namespace App\Filament\Resources\UserActivityHistoryLogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserActivityHistoryLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable(),

                TextColumn::make('details')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label("Logged At")
                    ->dateTime('d M Y, Hi')
                    ->suffix('hrs'),
            ])
            ->groups([
                Group::make('created_at')
                    ->orderQueryUsing(fn(Builder $query, string $direction) => $query->orderBy('created_at', 'desc'))
                    ->label("Logged At")
                    ->collapsible()
                    ->date(), // groups by day
            ])
            ->defaultGroup('created_at')
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ]);
        // ->recordActions([
        //     ViewAction::make(),
        //     EditAction::make(),
        // ])
        // ->toolbarActions([
        //     BulkActionGroup::make([
        //         DeleteBulkAction::make(),
        //     ]),
        // ]);
    }
}
