<?php

namespace App\Filament\Resources\Personnels\Schemas;

use App\Enum\PersonnelGender;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class PersonnelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('service_number')
                            ->required()
                            ->columnSpan(6),

                        Select::make('rank_id')
                            ->relationship('rank', 'code')
                            ->required()
                            ->columnSpan(6),

                        TextInput::make('last_name')
                            ->required()
                            ->columnSpan(6),

                        TextInput::make('other_names')
                            ->required()
                            ->columnSpan(6),

                        Select::make('gender')
                            ->options(PersonnelGender::class)
                            ->default('Male')
                            ->required()
                            ->columnSpan(6),

                        PhoneInput::make('phone')
                            ->initialCountry('gh')
                            ->columnSpan(6),

                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->columnSpan(6),
                    ])->columns(12)

            ])->columns(1);
    }
}