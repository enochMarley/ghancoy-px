<?php

namespace App\Filament\Resources\UserActivityHistoryLogs\Pages;

use App\Filament\Resources\UserActivityHistoryLogs\UserActivityHistoryLogResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUserActivityHistoryLog extends ViewRecord
{
    protected static string $resource = UserActivityHistoryLogResource::class;

    public static ?string $title = "View Log Details";

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
