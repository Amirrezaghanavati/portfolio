<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('case insensitive title search works', function () {
    Project::factory()->create(['title' => 'Inventory Optimizer']);
    Project::factory()->create(['title' => 'Payments Control Center']);

    get(route('portfolio', ['search' => 'inventory']))
        ->assertSuccessful()
        ->assertSee('Inventory Optimizer')
        ->assertDontSee('Payments Control Center');
});

test('search combines with active tags', function () {
    $match = Project::factory()->create(['title' => 'Billing Platform']);
    $wrongTag = Project::factory()->create(['title' => 'Billing Platform Enterprise']);
    $wrongSearch = Project::factory()->create(['title' => 'Analytics Workspace']);

    $match->syncTags(['Laravel']);
    $wrongTag->syncTags(['Vue']);
    $wrongSearch->syncTags(['Laravel']);

    get(route('portfolio', [
        'search' => 'billing',
        'tags' => ['Laravel'],
    ]))
        ->assertSuccessful()
        ->assertSee('Billing Platform')
        ->assertDontSee('Billing Platform Enterprise')
        ->assertDontSee('Analytics Workspace');
});

test('no results message appears when search has no matches', function () {
    Project::factory()->create(['title' => 'Client Portal']);

    get(route('portfolio', ['search' => 'nonexistent']))
        ->assertSuccessful()
        ->assertSee(__('site.portfolio.empty_title'));
});
