<?php

namespace App\Filament\Resources\Sales\Pages;

use App\Enum\SaleType;
use App\Filament\Resources\Sales\SaleResource;
use App\Models\Sale;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Enums\Size;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class ListSales extends ListRecords
{
    protected static string $resource = SaleResource::class;

    protected static ?string $title = 'Sales Records';

    protected function getHeaderActions(): array
    {
        $salesExists = Sale::exists();

        return [
            // Add new sale
            CreateAction::make()
                ->label("Add New Sale")
                ->outlined()
                ->color('primary')
                ->icon("heroicon-o-plus"),


            // Dropdown for printing data
            $salesExists ? ActionGroup::make([
                // Get personnel credit
                Action::make('get_personnel_credit')
                    ->label('Get Personnel Credit')
                    ->icon('heroicon-o-user-group')
                    ->url(route('sales.print.personnel-credit'))
                    ->openUrlInNewTab(),


                // Get credit history
                Action::make('get_credit_records')
                    ->label('Get Credit Records')
                    ->icon('heroicon-o-credit-card')
                    ->schema([
                        Select::make('mode')
                            ->label('Select Mode')
                            ->options([
                                'single' => 'Single Date',
                                'range' => 'Date Range',
                            ])
                            ->default('single')
                            ->reactive(),

                        DatePicker::make('single_date')
                            ->label('Date')
                            ->maxDate(now())
                            ->visible(fn($get) => $get('mode') === 'single')
                            ->required(fn($get) => $get('mode') === 'single'),

                        DatePicker::make('from_date')
                            ->label('From Date')
                            ->maxDate(now())
                            ->visible(fn($get) => $get('mode') === 'range')
                            ->required(fn($get) => $get('mode') === 'range'),

                        DatePicker::make('to_date')
                            ->label('To Date')
                            ->maxDate(now())
                            ->visible(fn($get) => $get('mode') === 'range')
                            ->required(fn($get) => $get('mode') === 'range'),
                    ])
                    ->action(function (array $data) {
                        if ($data['mode'] === 'single') {
                            $from = \Carbon\Carbon::parse($data['single_date'])->startOfDay();
                            $to   = \Carbon\Carbon::parse($data['single_date'])->endOfDay();
                        } else {
                            $from = \Carbon\Carbon::parse($data['from_date'])->startOfDay();
                            $to   = \Carbon\Carbon::parse($data['to_date'])->endOfDay();
                        }

                        return to_route('sales.print.credit-history', [
                            'from' => $from,
                            'to'   => $to,
                        ]);
                    }),


                // Get sale data
                Action::make('get_sale_records')
                    ->label('Get Sale Records')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Section::make()
                            ->schema([
                                Select::make('mode')
                                    ->label('Select Mode')
                                    ->options([
                                        'single' => 'Single Date',
                                        'range' => 'Date Range',
                                    ])
                                    ->default('single')
                                    ->reactive()
                                    ->columnSpan(4),

                                DatePicker::make('single_date')
                                    ->label('Date')
                                    ->maxDate(now())
                                    ->visible(fn($get) => $get('mode') === 'single')
                                    ->required(fn($get) => $get('mode') === 'single')
                                    ->columnSpan(4),

                                DatePicker::make('from_date')
                                    ->label('From Date')
                                    ->maxDate(now())
                                    ->visible(fn($get) => $get('mode') === 'range')
                                    ->required(fn($get) => $get('mode') === 'range')
                                    ->columnSpan(4),

                                DatePicker::make('to_date')
                                    ->label('To Date')
                                    ->maxDate(now())
                                    ->visible(fn($get) => $get('mode') === 'range')
                                    ->required(fn($get) => $get('mode') === 'range')
                                    ->columnSpan(4),
                            ])->columns(12)
                    ])
                    ->action(function (array $data) {
                        if ($data['mode'] === 'single') {
                            $from = \Carbon\Carbon::parse($data['single_date'])->startOfDay();
                            $to   = \Carbon\Carbon::parse($data['single_date'])->endOfDay();
                        } else {
                            $from = \Carbon\Carbon::parse($data['from_date'])->startOfDay();
                            $to   = \Carbon\Carbon::parse($data['to_date'])->endOfDay();
                        }

                        return to_route('sales.print.history', [
                            'from' => $from,
                            'to'   => $to,
                        ]);
                    }),
            ])
                ->label('GET REPORTS')
                ->icon('heroicon-m-ellipsis-vertical')
                ->size(Size::Small)
                ->color('primary')
                ->button() : Action::make('demo')->hidden(),

        ];
    }

    public function getTabs(): array
    {
        return [
            'Cash Sales' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('sale_type', SaleType::CASH)),

            'Sales on Credit' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('sale_type', SaleType::CREDIT)),
        ];
    }
}