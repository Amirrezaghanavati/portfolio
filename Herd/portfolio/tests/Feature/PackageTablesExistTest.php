<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

uses(RefreshDatabase::class);

test('package-backed tables exist with core columns', function () {
    expect(Schema::hasTable('media'))->toBeTrue();
    expect(Schema::hasColumns('media', [
        'id',
        'model_type',
        'model_id',
        'collection_name',
        'file_name',
    ]))->toBeTrue();

    expect(Schema::hasTable('tags'))->toBeTrue();
    expect(Schema::hasColumns('tags', ['id', 'name', 'slug', 'type']))->toBeTrue();

    expect(Schema::hasTable('taggables'))->toBeTrue();
    expect(Schema::hasColumns('taggables', ['tag_id', 'taggable_type', 'taggable_id']))->toBeTrue();

    expect(Schema::hasTable('seo'))->toBeTrue();
    expect(Schema::hasColumns('seo', ['id', 'model_type', 'model_id', 'title', 'description']))->toBeTrue();

    expect(Schema::hasTable('settings'))->toBeTrue();
    expect(Schema::hasColumns('settings', ['id', 'group', 'name', 'locked', 'payload']))->toBeTrue();
});
