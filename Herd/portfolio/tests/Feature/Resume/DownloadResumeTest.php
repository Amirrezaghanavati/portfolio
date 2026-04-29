<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('resume download returns attachment response', function () {
    Storage::fake('public');
    Storage::disk('public')->put('resume/amirreza-resume.pdf', 'pdf-content');

    $response = get(route('resume.download'));

    $response->assertSuccessful();
    $response->assertHeader('content-disposition');
});

test('download filename is human readable', function () {
    Storage::fake('public');
    Storage::disk('public')->put('resume/amirreza-resume.pdf', 'pdf-content');

    $response = get(route('resume.download'));

    $response->assertSuccessful();
    $response->assertHeader('content-disposition', 'attachment; filename=Amirreza-Resume.pdf');
});

test('returns not found when resume file is missing', function () {
    Storage::fake('public');

    $response = get(route('resume.download'));

    $response->assertNotFound();
});
