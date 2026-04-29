<?php

namespace App\Filament\Resources\ServiceRequests\Schemas;

use App\Enums\ServiceRequestBudgetRange;
use App\Enums\ServiceRequestProjectType;
use App\Enums\ServiceRequestStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ServiceRequestForm
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
                TextInput::make('company')
                    ->disabled(),
                Select::make('project_type')
                    ->options(ServiceRequestProjectType::class)
                    ->required()
                    ->disabled(),
                Select::make('budget_range')
                    ->options(ServiceRequestBudgetRange::class)
                    ->required()
                    ->disabled(),
                Textarea::make('description')
                    ->required()
                    ->disabled()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(ServiceRequestStatus::class)
                    ->default('new')
                    ->required(),
                TextInput::make('ip_address')
                    ->disabled(),
            ]);
    }
}
