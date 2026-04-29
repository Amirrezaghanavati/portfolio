<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('project can attach media', function () {
    Storage::fake('public');

    $project = Project::factory()->create();
    $project
        ->addMedia(UploadedFile::fake()->image('thumb.jpg'))
        ->toMediaCollection('thumbnails', 'public');

    expect($project->getMedia('thumbnails'))->toHaveCount(1);
});

test('project can assign tech tags', function () {
    $project = Project::factory()->create();
    $project->attachTag('Laravel', 'tech-stack');
    $project->attachTag('Livewire', 'tech-stack');

    expect($project->tags()->count())->toBe(2);
});

test('sortable order updates correctly', function () {
    $first = Project::factory()->create();
    $second = Project::factory()->create();

    Project::setNewOrder([$second->getKey(), $first->getKey()]); // id

    expect($second->fresh()->sort_order)->toBe(1);
    expect($first->fresh()->sort_order)->toBe(2);
});
