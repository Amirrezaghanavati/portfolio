<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('projects are sorted by sort order ascending', function () {
    Project::factory()->create([
        'title' => 'Third Project',
        'sort_order' => 3,
    ]);
    Project::factory()->create([
        'title' => 'First Project',
        'sort_order' => 1,
    ]);
    Project::factory()->create([
        'title' => 'Second Project',
        'sort_order' => 2,
    ]);

    get(route('portfolio'))
        ->assertSuccessful()
        ->assertSeeInOrder([
            'First Project',
            'Second Project',
            'Third Project',
        ], false);
});

test('pagination count per page is correct', function () {
    Project::factory()->count(7)->create();

    $response = get(route('portfolio'));

    $response->assertSuccessful();
    expect($response->viewData('projects')->count())->toBe(6);
});

test('empty state appears when no projects exist', function () {
    Project::query()->delete();

    get(route('portfolio'))
        ->assertSuccessful()
        ->assertSee(__('site.portfolio.empty_title'));
});
