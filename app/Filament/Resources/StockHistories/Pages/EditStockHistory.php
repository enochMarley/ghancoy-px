<?php

namespace App\Filament\Resources\StockHistories\Pages;

use App\Filament\Resources\StockHistories\StockHistoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStockHistory extends EditRecord
{
    protected static string $resource = StockHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // ViewAction::make(),
            // DeleteAction::make(),
        ];
    }
}
