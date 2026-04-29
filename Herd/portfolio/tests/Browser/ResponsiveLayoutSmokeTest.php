<?php

if (! function_exists('visit')) {
    test('browser responsive tests are unavailable', function () {
        expect(true)->toBeTrue();
    })->skip('Pest browser helpers are not available in this environment.');

    return;
}

test('core pages render without javascript errors in mobile viewport', function () {
    $pages = visit(['/', '/portfolio', '/about', '/resume', '/services', '/contact'], [
        'viewport' => ['width' => 390, 'height' => 844],
    ]);

    $pages->assertNoJavaScriptErrors();
});
