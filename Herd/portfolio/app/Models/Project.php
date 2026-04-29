<?php

namespace App\Models;

use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

#[Fillable([
    'title',
    'slug',
    'summary',
    'description',
    'live_url',
    'repo_url',
    'featured',
    'sort_order',
])]
class Project extends Model implements HasMedia, Sortable
{
    /** @use HasFactory<ProjectFactory> */
    use HasFactory;

    use HasSEO;
    use HasTags;
    use InteractsWithMedia;
    use SortableTrait;

    protected $attributes = [
        'featured' => false,
        'sort_order' => 0,
    ];

    public array $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected function casts(): array
    {
        return [
            'featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
