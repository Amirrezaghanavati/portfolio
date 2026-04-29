<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('expected public named routes exist', function () {
    expect(Route::has('home'))->toBeTrue();
    expect(Route::has('portfolio'))->toBeTrue();
    expect(Route::has('about'))->toBeTrue();
    expect(Route::has('resume'))->toBeTrue();
    expect(Route::has('services'))->toBeTrue();
    expect(Route::has('contact'))->toBeTrue();
    expect(Route::has('resume.download'))->toBeTrue();
});

test('public named routes respond successfully', function (string $routeName) {
    if ($routeName === 'resume.download') {
        Storage::fake('public');
        Storage::disk('public')->put('resume/amirreza-resume.pdf', 'resume-content');
    }

    get(route($routeName))->assertSuccessful();
})->with([
    'home',
    'portfolio',
    'about',
    'resume',
    'services',
    'contact',
    'resume.download',
]);
