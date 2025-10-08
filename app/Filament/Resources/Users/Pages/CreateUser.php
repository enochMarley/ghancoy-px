<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Add User';

    // Redirect to index page after creating new data
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
