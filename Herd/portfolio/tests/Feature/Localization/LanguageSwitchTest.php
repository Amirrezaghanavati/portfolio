<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('english locale renders translated static text', function () {
    session(['locale' => 'en']);

    get(route('home'))
        ->assertSuccessful()
        ->assertSee('Home')
        ->assertSee('Get started');
});

test('language switch route stores selected locale and redirects back', function () {
    get(route('locale.switch', 'fa'), [
        'Referer' => route('home'),
    ])->assertRedirect(route('home'));

    session(['locale' => 'fa']);

    get(route('home'))
        ->assertSuccessful()
        ->assertSee('خانه')
        ->assertSee('شروع کنیم');
});
