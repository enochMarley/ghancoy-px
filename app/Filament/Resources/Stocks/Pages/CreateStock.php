<?php

namespace App\Filament\Resources\Stocks\Pages;

use App\Filament\Resources\Stocks\StockResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStock extends CreateRecord
{
    protected static string $resource = StockResource::class;

    protected static ?string $title = 'Add Stock';

    // Redirect to index page after creating new data
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
