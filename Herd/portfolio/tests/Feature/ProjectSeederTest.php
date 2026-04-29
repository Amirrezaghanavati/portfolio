<?php

use App\Models\Project;
use Database\Seeders\ProjectSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

uses(RefreshDatabase::class);

test('project seeder creates starter project records', function () {
    Artisan::call('db:seed', ['--class' => ProjectSeeder::class]);

    expect(Project::query()->count())->toBeGreaterThanOrEqual(2);
});

test('project seeder creates at least two featured projects for the home preview', function () {
    Artisan::call('db:seed', ['--class' => ProjectSeeder::class]);

    expect(Project::query()->where('featured', true)->count())->toBeGreaterThanOrEqual(2);
});
