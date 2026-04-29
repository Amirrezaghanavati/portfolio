<?php

if (! function_exists('visit')) {
    test('browser navigation tests are unavailable', function () {
        expect(true)->toBeTrue();
    })->skip('Pest browser helpers are not available in this environment.');

    return;
}

test('navigation works with browser history and without javascript errors', function () {
    $page = visit('/');

    $page->assertNoJavaScriptErrors()
        ->click('Portfolio')
        ->assertPathIs('/portfolio')
        ->assertSee('Selected projects and product thinking.')
        ->back()
        ->assertPathIs('/')
        ->assertSee('Build with confidence, ship with style.');
});
