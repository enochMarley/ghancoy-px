<?php

namespace App\Filament\Resources\UserActivityHistoryLogs\Pages;

use App\Filament\Resources\UserActivityHistoryLogs\UserActivityHistoryLogResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUserActivityHistoryLog extends EditRecord
{
    protected static string $resource = UserActivityHistoryLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // ViewAction::make(),
            // DeleteAction::make(),
        ];
    }
}