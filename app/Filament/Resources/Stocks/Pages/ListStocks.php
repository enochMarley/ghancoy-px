<?php

namespace App\Filament\Resources\Stocks\Pages;

use App\Enum\StockCategory;
use App\Filament\Resources\Stocks\StockResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListStocks extends ListRecords
{
    protected static string $resource = StockResource::class;

    protected static ?string $title = 'Items Stock';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label("Add New Stock")
                ->outlined()
                ->color('primary')
                ->icon("heroicon-o-plus"),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [];

        foreach (StockCategory::cases() as $stockCategory) {
            $tabs[$stockCategory->label()] = Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('category', $stockCategory));
        }

        return $tabs;
    }
}
