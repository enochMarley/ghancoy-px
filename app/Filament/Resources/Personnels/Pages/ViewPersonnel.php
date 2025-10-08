<?php

namespace App\Filament\Resources\Personnels\Pages;

use App\Filament\Resources\Personnels\PersonnelResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPersonnel extends ViewRecord
{
    protected static string $resource = PersonnelResource::class;

    protected static ?string $title = 'Personnel Details';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Edit Details')
                ->icon('heroicon-o-pencil')
                ->outlined(),

            DeleteAction::make()
                ->label('Delete Personnel')
                ->icon('heroicon-o-trash')
        ];
    }
}
