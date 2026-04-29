<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

uses(RefreshDatabase::class);

test('service_requests table has expected columns', function () {
    expect(Schema::hasTable('service_requests'))->toBeTrue();
    expect(Schema::hasColumns('service_requests', [
        'id',
        'name',
        'email',
        'company',
        'project_type',
        'budget_range',
        'description',
        'status',
        'ip_address',
        'created_at',
        'updated_at',
    ]))->toBeTrue();
});

test('service_requests status defaults to new', function () {
    $statusColumn = collect(Schema::getColumns('service_requests'))
        ->firstWhere('name', 'status');

    expect($statusColumn)->toBeArray();

    $default = $statusColumn['default']
        ?? $statusColumn['default_value']
        ?? null;

    expect(trim((string) $default, "'\""))->toBe('new');
});
