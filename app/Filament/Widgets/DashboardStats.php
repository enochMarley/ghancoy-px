<?php

namespace App\Filament\Widgets;

use App\Enum\SaleType;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\Personnel;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class DashboardStats extends BaseWidget
{
    protected static ?int $sort = 1; // show at top

    protected function getStats(): array
    {
        // 🔹 Total stock items in inventory
        $totalStockItems = Stock::count();

        // 🔹 Number of stock sold today
        $todayStockSold = Sale::whereDate('sales.created_at', today())
            ->join('stocks', 'sales.stock_id', '=', 'stocks.id')
            ->select(DB::raw('SUM(sales.quantity) as total'))
            ->value('total') ?? 0;

        // 🔹 Total personnel who owe (have credit sales)
        $personnelOwing = Sale::where('sale_type', 'credit')
            ->distinct('personnel_id')
            ->count('personnel_id');

        // 🔹 Total amount owed across all personnel
        $totalOwed = Sale::where('sale_type', 'credit')
            ->join('stocks', 'sales.stock_id', '=', 'stocks.id')
            ->select(DB::raw('SUM(sales.quantity * stocks.unit_selling_price) as total'))
            ->value('total') ?? 0;

        // 🔹 Today's cash sales
        $todayCash = Sale::where('sale_type', SaleType::CASH->value)
            ->whereDate('sales.created_at', today())
            ->join('stocks', 'sales.stock_id', '=', 'stocks.id')
            ->select(DB::raw('SUM(sales.quantity * stocks.unit_selling_price) as total'))
            ->value('total') ?? 0;

        // 🔹 Todays credit sales
        $todayCredit = Sale::where('sale_type', SaleType::CREDIT->value)
            ->whereDate('sales.created_at', today())
            ->join('stocks', 'sales.stock_id', '=', 'stocks.id')
            ->select(DB::raw('SUM(sales.quantity * stocks.unit_selling_price) as total'))
            ->value('total') ?? 0;


        return [
            Stat::make('Stock Items', $totalStockItems)
                ->description('Items in inventory')
                ->icon('heroicon-o-archive-box')
                ->color('primary'),

            Stat::make('Items Sold Today', $todayStockSold)
                ->description('Total number of items sold today')
                ->icon('heroicon-o-archive-box')
                ->color('primary'),

            Stat::make('Personnel Owing', $personnelOwing)
                ->description('People with outstanding credit')
                ->icon('heroicon-o-user-group')
                ->color('warning'),

            Stat::make('Total Amount Owed', 'FCFA ' . number_format($totalOwed, 2))
                ->description('Outstanding credit balance')
                ->icon('heroicon-o-banknotes')
                ->color('danger'),

            Stat::make("Todays Cash Sales", 'FCFA ' . number_format($todayCash, 2))
                ->description('Cash collected today')
                ->icon('heroicon-o-currency-dollar')
                ->color('success'),

            Stat::make("Today's Credit Sales", 'FCFA ' . number_format($todayCredit, 2))
                ->description('Sales on credit today')
                ->icon('heroicon-o-currency-dollar')
                ->color('success'),

        ];
    }
}
