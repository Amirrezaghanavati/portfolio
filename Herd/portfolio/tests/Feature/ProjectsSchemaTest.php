<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

uses(RefreshDatabase::class);

test('projects table has expected columns and indexes', function () {
    expect(Schema::hasTable('projects'))->toBeTrue();
    expect(Schema::hasColumns('projects', [
        'id',
        'title',
        'slug',
        'summary',
        'description',
        'live_url',
        'repo_url',
        'featured',
        'sort_order',
        'created_at',
        'updated_at',
    ]))->toBeTrue();

    $indexes = Schema::getIndexes('projects');
    $slugIndex = collect($indexes)->first(function (array $index) {
        $columns = $index['columns'] ?? [];
        $isUnique = ($index['unique'] ?? false) === true
            || ($index['type'] ?? null) === 'unique';

        return in_array('slug', $columns, true) && $isUnique;
    });

    expect($slugIndex)->toBeArray();
});

test('projects featured defaults to false when omitted', function () {
    $attributes = Project::factory()->raw();
    unset($attributes['featured']);

    $project = Project::query()->create($attributes);

    expect($project->fresh()->featured)->toBeFalse();
});
