<?php

namespace App\Filament\Resources\UserActivityHistoryLogs\Pages;

use App\Filament\Resources\UserActivityHistoryLogs\UserActivityHistoryLogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUserActivityHistoryLog extends CreateRecord
{
    protected static string $resource = UserActivityHistoryLogResource::class;
}
