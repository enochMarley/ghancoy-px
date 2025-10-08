<?php

namespace App\Filament\Resources\Sales;

use App\Filament\Resources\Sales\Pages\CreateSale;
use App\Filament\Resources\Sales\Pages\EditSale;
use App\Filament\Resources\Sales\Pages\ListSales;
use App\Filament\Resources\Sales\Pages\ViewSale;
use App\Filament\Resources\Sales\Schemas\SaleForm;
use App\Filament\Resources\Sales\Schemas\SaleInfolist;
use App\Filament\Resources\Sales\Tables\SalesTable;
use App\Models\Sale;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowsUpDown;

    protected static string | UnitEnum| null $navigationGroup = 'Sales Management';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'stock.name';

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return $record->stock->name;
    }


    public static function getGloballySearchableAttributes(): array
    {
        return ['stock.name', 'quantity', 'sale_type'];
    }


    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Name' => $record->stock->name,
            'Quantity' => $record->quantity,
            'Sale Type' => $record->sale_type->value,
        ];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return SaleResource::getUrl('view', ['record' => $record]);
    }

    public static function form(Schema $schema): Schema
    {
        return SaleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SaleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SalesTable::configure($table);
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
            'index' => ListSales::route('/'),
            'create' => CreateSale::route('/create'),
            'view' => ViewSale::route('/{record}'),
            'edit' => EditSale::route('/{record}/edit'),
        ];
    }
}
