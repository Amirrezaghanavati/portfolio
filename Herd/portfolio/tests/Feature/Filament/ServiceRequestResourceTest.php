<?php

use App\Enums\ServiceRequestStatus;
use App\Filament\Resources\ServiceRequests\Pages\EditServiceRequest;
use App\Filament\Resources\ServiceRequests\Pages\ListServiceRequests;
use App\Filament\Resources\ServiceRequests\ServiceRequestResource;
use App\Models\ServiceRequest;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\Testing\TestAction;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('list page loads and sorts newest first', function () {
    /** @var Authenticatable $admin */
    $admin = User::factory()->createOne();
    actingAs($admin);

    $old = ServiceRequest::factory()->create(['created_at' => now()->subDay()]);
    $new = ServiceRequest::factory()->create(['created_at' => now()]);

    Livewire::test(ListServiceRequests::class)
        ->assertOk()
        ->assertCanSeeTableRecords([$new, $old], inOrder: true);
});

test('create action is unavailable', function () {
    expect(array_key_exists('create', ServiceRequestResource::getPages()))->toBeFalse();
});

test('admin can update status and delete record', function () {
    /** @var Authenticatable $admin */
    $admin = User::factory()->createOne();
    actingAs($admin);

    $record = ServiceRequest::factory()->create(['status' => ServiceRequestStatus::New->value]);

    Livewire::test(EditServiceRequest::class, ['record' => $record->getRouteKey()])
        ->fillForm([
            'status' => ServiceRequestStatus::Replied->value,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($record->fresh()->status)->toBe(ServiceRequestStatus::Replied);

    Livewire::test(EditServiceRequest::class, ['record' => $record->getRouteKey()])
        ->callAction(TestAction::make(DeleteAction::class));

    expect(ServiceRequest::query()->whereKey($record->getKey())->exists())->toBeFalse();
});
