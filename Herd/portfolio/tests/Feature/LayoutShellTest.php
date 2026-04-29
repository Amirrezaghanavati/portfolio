<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('public pages render with semantic layout shell', function (string $routeName) {
    $response = get(route($routeName));

    $response->assertSuccessful();
    $response->assertSee('<header', false);
    $response->assertSee('<main', false);
    $response->assertSee('<footer', false);
})->with([
    'home',
    'portfolio',
    'about',
    'resume',
    'services',
    'contact',
]);

test('resume download endpoint responds successfully', function () {
    Storage::fake('public');
    Storage::disk('public')->put('resume/amirreza-resume.pdf', 'resume-content');

    $response = get(route('resume.download'));

    $response->assertSuccessful();
});
