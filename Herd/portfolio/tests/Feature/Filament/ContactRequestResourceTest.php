<?php

use App\Enums\ContactRequestStatus;
use App\Filament\Resources\ContactRequests\ContactRequestResource;
use App\Filament\Resources\ContactRequests\Pages\EditContactRequest;
use App\Filament\Resources\ContactRequests\Pages\ListContactRequests;
use App\Models\ContactRequest;
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

    $old = ContactRequest::factory()->create(['created_at' => now()->subDay()]);
    $new = ContactRequest::factory()->create(['created_at' => now()]);

    Livewire::test(ListContactRequests::class)
        ->assertOk()
        ->assertCanSeeTableRecords([$new, $old], inOrder: true);
});

test('create action is unavailable', function () {
    expect(array_key_exists('create', ContactRequestResource::getPages()))->toBeFalse();
});

test('admin can update status and delete record', function () {
    /** @var Authenticatable $admin */
    $admin = User::factory()->createOne();
    actingAs($admin);

    $record = ContactRequest::factory()->create(['status' => ContactRequestStatus::New->value]);

    Livewire::test(EditContactRequest::class, ['record' => $record->getRouteKey()])
        ->fillForm([
            'status' => ContactRequestStatus::Replied->value,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($record->fresh()->status)->toBe(ContactRequestStatus::Replied);

    Livewire::test(EditContactRequest::class, ['record' => $record->getRouteKey()])
        ->callAction(TestAction::make(DeleteAction::class));

    expect(ContactRequest::query()->whereKey($record->getKey())->exists())->toBeFalse();
});
