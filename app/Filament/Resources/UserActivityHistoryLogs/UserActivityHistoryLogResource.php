<?php

namespace App\Filament\Resources\UserActivityHistoryLogs;

use App\Filament\Resources\UserActivityHistoryLogs\Pages\CreateUserActivityHistoryLog;
use App\Filament\Resources\UserActivityHistoryLogs\Pages\EditUserActivityHistoryLog;
use App\Filament\Resources\UserActivityHistoryLogs\Pages\ListUserActivityHistoryLogs;
use App\Filament\Resources\UserActivityHistoryLogs\Pages\ViewUserActivityHistoryLog;
use App\Filament\Resources\UserActivityHistoryLogs\Schemas\UserActivityHistoryLogForm;
use App\Filament\Resources\UserActivityHistoryLogs\Schemas\UserActivityHistoryLogInfolist;
use App\Filament\Resources\UserActivityHistoryLogs\Tables\UserActivityHistoryLogsTable;
use App\Models\UserActivityHistoryLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class UserActivityHistoryLogResource extends Resource
{
    protected static ?string $model = UserActivityHistoryLog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    protected static string | UnitEnum| null $navigationGroup = 'User Management';

    protected static ?int $navigationSort = 7;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return UserActivityHistoryLogForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserActivityHistoryLogInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserActivityHistoryLogsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUserActivityHistoryLogs::route('/'),
            'create' => CreateUserActivityHistoryLog::route('/create'),
            'view' => ViewUserActivityHistoryLog::route('/{record}'),
            'edit' => EditUserActivityHistoryLog::route('/{record}/edit'),
        ];
    }
}