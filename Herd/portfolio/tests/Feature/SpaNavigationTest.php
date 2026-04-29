<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('pages render expected title', function (string $routeName, string $title) {
    $response = get(route($routeName));

    $response->assertSuccessful();
    $response->assertSee('<title>'.$title.'</title>', false);
})->with([
    ['home', 'Home'],
    ['portfolio', 'Portfolio'],
    ['about', 'About'],
    ['resume', 'Resume'],
    ['services', 'Services'],
    ['contact', 'Contact'],
]);

test('active nav link marker appears for each route', function (string $routeName, string $linkLabel) {
    $response = get(route($routeName));

    $response->assertSuccessful();
    $response->assertSee('aria-current="page"', false);
    $response->assertSee($linkLabel);
})->with([
    ['home', 'Home'],
    ['portfolio', 'Portfolio'],
    ['about', 'About'],
    ['resume', 'Resume'],
    ['services', 'Services'],
    ['contact', 'Contact'],
]);
