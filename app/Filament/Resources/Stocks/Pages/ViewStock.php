<?php

namespace App\Filament\Resources\Stocks\Pages;

use App\Filament\Resources\Stocks\StockResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStock extends ViewRecord
{
    protected static string $resource = StockResource::class;

    protected static ?string $title = 'Stock Details';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Edit Details')
                ->icon('heroicon-o-pencil')
                ->outlined(),

            DeleteAction::make()
                ->label('Delete Stock')
                ->icon('heroicon-o-trash')
        ];
    }
}
