<?php

namespace App\Models;

use App\Enums\ServiceRequestBudgetRange;
use App\Enums\ServiceRequestProjectType;
use App\Enums\ServiceRequestStatus;
use Database\Factories\ServiceRequestFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'email',
    'company',
    'project_type',
    'budget_range',
    'description',
    'status',
    'ip_address',
])]
class ServiceRequest extends Model
{
    /** @use HasFactory<ServiceRequestFactory> */
    use HasFactory;

    protected $attributes = [
        'status' => ServiceRequestStatus::New->value,
    ];

    protected function casts(): array
    {
        return [
            'project_type' => ServiceRequestProjectType::class,
            'budget_range' => ServiceRequestBudgetRange::class,
            'status' => ServiceRequestStatus::class,
        ];
    }
}
