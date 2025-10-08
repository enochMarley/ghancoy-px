<?php

namespace App\Filament\Resources\Personnels\Pages;

use App\Filament\Resources\Personnels\PersonnelResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePersonnel extends CreateRecord
{
    protected static string $resource = PersonnelResource::class;

    protected static ?string $title = 'Add Personnel Record';

    // Redirect to index page after creating new data
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
