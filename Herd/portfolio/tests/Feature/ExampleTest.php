<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('the application returns a successful response', function () {
    $response = get('/');

    $response->assertSuccessful();
});
