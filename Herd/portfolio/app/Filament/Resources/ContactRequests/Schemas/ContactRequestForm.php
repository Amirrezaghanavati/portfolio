<?php

namespace App\Filament\Resources\ContactRequests\Schemas;

use App\Enums\ContactRequestStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->disabled(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->disabled(),
                TextInput::make('phone')
                    ->tel()
                    ->disabled(),
                Textarea::make('message')
                    ->required()
                    ->disabled()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(ContactRequestStatus::class)
                    ->default('new')
                    ->required(),
                TextInput::make('ip_address')
                    ->disabled(),
            ]);
    }
}
