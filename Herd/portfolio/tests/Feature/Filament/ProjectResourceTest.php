<?php

use App\Filament\Resources\Projects\Pages\CreateProject;
use App\Filament\Resources\Projects\Pages\EditProject;
use App\Filament\Resources\Projects\Pages\ListProjects;
use App\Models\Project;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\Testing\TestAction;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('resource list page loads for admin', function () {
    /** @var Authenticatable $admin */
    $admin = User::factory()->createOne();
    actingAs($admin);

    Livewire::test(ListProjects::class)
        ->assertOk();
});

test('admin can create edit and delete a project', function () {
    /** @var Authenticatable $admin */
    $admin = User::factory()->createOne();
    actingAs($admin);

    Livewire::test(CreateProject::class)
        ->fillForm([
            'title' => 'Admin Created Project',
            'slug' => 'admin-created-project',
            'summary' => 'Admin created summary',
            'description' => 'Detailed project description',
            'live_url' => 'https://example.com/live',
            'repo_url' => 'https://github.com/example/repo',
            'featured' => false,
            'sort_order' => 10,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $project = Project::query()->where('slug', 'admin-created-project')->firstOrFail();

    Livewire::test(EditProject::class, ['record' => $project->getRouteKey()])
        ->fillForm([
            'title' => 'Admin Updated Project',
            'slug' => 'admin-created-project',
            'summary' => 'Updated summary',
            'description' => 'Updated description',
            'live_url' => 'https://example.com/live',
            'repo_url' => 'https://github.com/example/repo',
            'featured' => false,
            'sort_order' => 10,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($project->fresh()->title)->toBe('Admin Updated Project');

    Livewire::test(EditProject::class, ['record' => $project->getRouteKey()])
        ->callAction(TestAction::make(DeleteAction::class))
        ->assertHasNoFormErrors();

    expect(Project::query()->whereKey($project->getKey())->exists())->toBeFalse();
});

test('reordering updates sort_order', function () {
    /** @var Authenticatable $admin */
    $admin = User::factory()->createOne();
    actingAs($admin);

    $first = Project::factory()->create(['sort_order' => 1]);
    $second = Project::factory()->create(['sort_order' => 2]);

    Livewire::test(ListProjects::class)
        ->call('reorderTable', [$second->getKey(), $first->getKey()]);

    expect($second->fresh()->sort_order)->toBe(1);
    expect($first->fresh()->sort_order)->toBe(2);
});

test('featured toggle persists', function () {
    /** @var Authenticatable $admin */
    $admin = User::factory()->createOne();
    actingAs($admin);

    $project = Project::factory()->create(['featured' => false]);

    Livewire::test(EditProject::class, ['record' => $project->getRouteKey()])
        ->fillForm([
            'title' => $project->title,
            'slug' => $project->slug,
            'summary' => $project->summary,
            'description' => $project->description,
            'live_url' => $project->live_url,
            'repo_url' => $project->repo_url,
            'featured' => true,
            'sort_order' => $project->sort_order,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($project->fresh()->featured)->toBeTrue();
});
