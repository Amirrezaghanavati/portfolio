<?php

use App\Models\Project;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('default order scope sorts by sort_order ascending', function () {
    [$a, $b, $c] = Project::factory()->count(3)->create();

    $a->update(['sort_order' => 30]);
    $b->update(['sort_order' => 10]);
    $c->update(['sort_order' => 20]);

    $orderedIds = Project::query()->ordered()->pluck('id')->all();

    expect($orderedIds)->toBe([$b->id, $c->id, $a->id]);
});

test('slug uniqueness is enforced at database layer', function () {
    $slug = 'my-unique-project';

    Project::factory()->create(['slug' => $slug]);

    expect(fn () => Project::factory()->create(['slug' => $slug]))
        ->toThrow(QueryException::class);
});
