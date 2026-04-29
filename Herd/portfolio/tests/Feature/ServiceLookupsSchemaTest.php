<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

uses(RefreshDatabase::class);

test('service lookup tables are not present by default', function () {
    expect(Schema::hasTable('service_types'))->toBeFalse();
    expect(Schema::hasTable('budget_ranges'))->toBeFalse();
});
