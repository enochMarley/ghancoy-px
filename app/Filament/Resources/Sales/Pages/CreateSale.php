<?php

namespace App\Filament\Resources\Sales\Pages;

use App\Filament\Resources\Sales\SaleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSale extends CreateRecord
{
    protected static string $resource = SaleResource::class;

    protected static ?string $title = 'Add Sale';

    // Redirect to index page after creating new data
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
