<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

uses(RefreshDatabase::class);

test('contact_requests table has expected columns', function () {
    expect(Schema::hasTable('contact_requests'))->toBeTrue();
    expect(Schema::hasColumns('contact_requests', [
        'id',
        'name',
        'email',
        'phone',
        'message',
        'status',
        'ip_address',
        'created_at',
        'updated_at',
    ]))->toBeTrue();
});

test('contact_requests status defaults to new', function () {
    $statusColumn = collect(Schema::getColumns('contact_requests'))
        ->firstWhere('name', 'status');

    expect($statusColumn)->toBeArray();

    $default = $statusColumn['default']
        ?? $statusColumn['default_value']
        ?? null;

    expect(trim((string) $default, "'\""))->toBe('new');
});
