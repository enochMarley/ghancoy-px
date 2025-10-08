<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DashboardStats;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Icons\Heroicon;
use Filament\View\PanelsIconAlias;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BaseDashboard
{
    protected static ?int $navigationSort = -1;

    // navigation icon
    public static function getNavigationIcon(): string | BackedEnum | Htmlable| null
    {
        return static::$navigationIcon
            ?? FilamentIcon::resolve(PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM)
            ?? (Filament::hasTopNavigation() ? Heroicon::Home : Heroicon::OutlinedChartPie);
    }

    public function getWidgets(): array
    {
        return [
            DashboardStats::class,
        ];
    }
}
