<?php

namespace App\Filament\Resources\Personnels\Schemas;

use App\Enum\PersonnelGender;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class PersonnelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('service_number')
                    ->required()
                    ->columnSpan(4),

                Select::make('rank_id')
                    ->relationship('rank', 'code')
                    ->required()
                    ->columnSpan(4),

                TextInput::make('last_name')
                    ->required()
                    ->columnSpan(4),

                TextInput::make('other_names')
                    ->required()
                    ->columnSpan(4),

                Select::make('gender')
                    ->options(PersonnelGender::class)
                    ->default('Male')
                    ->required()
                    ->columnSpan(4),

                PhoneInput::make('phone')
                    ->initialCountry('gh')
                    ->required()
                    ->columnSpan(4),

                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->columnSpan(4),

            ])->columns(12);
    }
}
