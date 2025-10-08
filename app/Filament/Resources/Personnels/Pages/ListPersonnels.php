<?php

namespace App\Filament\Resources\Personnels\Pages;

use App\Enum\PersonnelType;
use App\Filament\Resources\Personnels\PersonnelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ActionGroup;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPersonnels extends ListRecords
{
    protected static string $resource = PersonnelResource::class;

    protected static ?string $title = 'Personnel Records';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label("Add New Personnel")
                ->outlined()
                ->color('primary')
                ->icon("heroicon-o-plus"),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Officers' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', PersonnelType::OFFICER)),

            'Other Ranks' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', PersonnelType::OTHER_RANK)),

            'Civilian Employees' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', PersonnelType::CIVILIAN_EMPLOYEE)),
        ];
    }
}
