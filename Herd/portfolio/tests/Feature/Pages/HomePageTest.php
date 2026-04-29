<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('hero content and cta links render', function () {
    $response = get(route('home'));

    $response->assertSuccessful();
    $response->assertSee('Build with confidence, ship with style.');
    $response->assertSee('Get started');
    $response->assertSee(route('services'));
    $response->assertSee(route('contact'));
});

test('featured section hides when no featured projects', function () {
    Project::query()->delete();

    $response = get(route('home'));

    $response->assertSuccessful();
    $response->assertDontSee('Featured Projects');
});

test('services snapshot cards render with correct links', function () {
    $response = get(route('home'));

    $response->assertSuccessful();
    $response->assertSee('Services Snapshot');
    $response->assertSee('Website Design & Development', false);
    $response->assertSee(route('services'));
    $response->assertSee(route('contact'));
});

test('bottom cta is present', function () {
    $response = get(route('home'));

    $response->assertSuccessful();
    $response->assertSee('Ready to launch something exceptional?');
    $response->assertSee('Start a project');
});
