<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('about page has expected headings and sections', function () {
    $response = get(route('about'));

    $response->assertSuccessful();
    $response->assertSee('Bio');
    $response->assertSee('Avatar');
    $response->assertSee('Skills');
    $response->assertSee('Experience Timeline');
});

test('skills and timeline data render', function () {
    $response = get(route('about'));

    $response->assertSuccessful();
    $response->assertSee('Laravel, Eloquent, API design');
    $response->assertSee('Livewire, Tailwind CSS, Alpine.js');
    $response->assertSee('2026 - Present: Senior Laravel Engineer');
});
