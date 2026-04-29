<?php

if (! function_exists('visit')) {
    test('browser dark mode tests are unavailable', function () {
        expect(true)->toBeTrue();
    })->skip('Pest browser helpers are not available in this environment.');

    return;
}

test('dark mode toggle stores preference and applies it on revisit', function () {
    $page = visit('/');

    $page->assertNoJavaScriptErrors()
        ->click('Theme')
        ->assertScript('localStorage.getItem("theme")', 'dark')
        ->refresh()
        ->assertScript('document.documentElement.classList.contains("dark")', true);
});
