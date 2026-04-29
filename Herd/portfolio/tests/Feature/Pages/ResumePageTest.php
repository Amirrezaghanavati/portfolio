<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('includes resume heading', function () {
    $response = get(route('resume'));

    $response->assertSuccessful();
    $response->assertSee('<h1 class="text-3xl font-semibold tracking-tight sm:text-4xl">Resume</h1>', false);
});

test('contains iframe with storage-backed resume url', function () {
    Storage::fake('public');
    Storage::disk('public')->put('resume/amirreza-resume.pdf', 'pdf-content');

    $response = get(route('resume'));

    $response->assertSuccessful();
    $response->assertSee('<iframe', false);
    $response->assertSee(Storage::disk('public')->url('resume/amirreza-resume.pdf'));
});

test('shows fallback message when resume is missing', function () {
    Storage::fake('public');

    $response = get(route('resume'));

    $response->assertSuccessful();
    $response->assertSee('Resume file is currently unavailable. Please check back soon.');
    $response->assertDontSee('<iframe', false);
});
