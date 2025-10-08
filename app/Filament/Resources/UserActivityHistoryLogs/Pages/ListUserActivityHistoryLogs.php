<?php

namespace App\Filament\Resources\UserActivityHistoryLogs\Pages;

use App\Filament\Resources\UserActivityHistoryLogs\UserActivityHistoryLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserActivityHistoryLogs extends ListRecords
{
    protected static string $resource = UserActivityHistoryLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
