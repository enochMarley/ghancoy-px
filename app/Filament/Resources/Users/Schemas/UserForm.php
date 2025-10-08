<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->required(),

                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required(),

                        TextInput::make('phone')
                            ->tel(),

                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->visibleOn('create'),

                        Select::make('role')
                            ->options(['admin' => 'Admin', 'editor' => 'Editor'])
                            ->default('admin')
                            ->required(),

                        Toggle::make('status')
                            ->required(),
                    ])
            ]);
    }
}
