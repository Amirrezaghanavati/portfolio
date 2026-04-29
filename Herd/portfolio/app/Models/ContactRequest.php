<?php

namespace App\Models;

use App\Enums\ContactRequestStatus;
use Database\Factories\ContactRequestFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'email',
    'phone',
    'message',
    'status',
    'ip_address',
])]
class ContactRequest extends Model
{
    /** @use HasFactory<ContactRequestFactory> */
    use HasFactory;

    protected $attributes = [
        'status' => ContactRequestStatus::New->value,
    ];

    protected function casts(): array
    {
        return [
            'status' => ContactRequestStatus::class,
        ];
    }
}
