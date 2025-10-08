<?php

namespace App\Filament\Resources\Personnels\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PersonnelsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->defaultSort('service_number', 'asc')
            ->columns([
                TextColumn::make('service_number')
                    ->searchable(),

                TextColumn::make('rank.code')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('last_name')
                    ->searchable(),

                TextColumn::make('other_names')
                    ->searchable(),

                TextColumn::make('gender')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
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
