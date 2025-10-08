<?php

namespace App\Filament\Resources\Users\Pages;

use App\Enum\UserRole;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;


class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'List of Users';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label("Add New User")
                ->outlined()
                ->icon("heroicon-o-plus"),
        ];
    }


    public function getTabs(): array
    {
        return [
            'Admins' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('role', UserRole::ADMIN)),

            'Editors' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('role', UserRole::EDITOR)),
        ];
    }
}
