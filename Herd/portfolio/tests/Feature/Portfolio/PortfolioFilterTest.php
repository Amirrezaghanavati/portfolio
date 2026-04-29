<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('filtering by one or multiple tags returns matching projects', function () {
    $laravelProject = Project::factory()->create(['title' => 'Laravel CRM']);
    $livewireProject = Project::factory()->create(['title' => 'Livewire Portal']);
    $mixedProject = Project::factory()->create(['title' => 'Studio Dashboard']);

    $laravelProject->syncTags(['Laravel']);
    $livewireProject->syncTags(['Livewire']);
    $mixedProject->syncTags(['Laravel', 'Livewire']);

    get(route('portfolio', ['tags' => ['Laravel']]))
        ->assertSuccessful()
        ->assertSee('Laravel CRM')
        ->assertSee('Studio Dashboard')
        ->assertDontSee('Livewire Portal');

    get(route('portfolio', ['tags' => ['Laravel', 'Livewire']]))
        ->assertSuccessful()
        ->assertSee('Laravel CRM')
        ->assertSee('Livewire Portal')
        ->assertSee('Studio Dashboard');
});

test('clear filters resets selected filters', function () {
    Project::factory()->create(['title' => 'Tagged Project'])->syncTags(['Laravel']);

    get(route('portfolio', ['tags' => ['Laravel'], 'search' => 'tagged']))
        ->assertSuccessful()
        ->assertSee(__('site.portfolio.clear_filters'))
        ->assertSee(route('portfolio'));
});

test('pagination resets to first page after filter change', function () {
    Project::factory()->count(7)->create()->each(function (Project $project): void {
        $project->syncTags(['Laravel']);
    });

    $response = get(route('portfolio', [
        'page' => 2,
        'tags' => ['Laravel'],
    ]));

    $response->assertSuccessful();
    expect($response->viewData('projects')->currentPage())->toBe(2);

    $filteredResponse = get(route('portfolio', ['tags' => ['Laravel']]));

    $filteredResponse->assertSuccessful();
    expect($filteredResponse->viewData('projects')->currentPage())->toBe(1);
});
