<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Page extends BaseModel implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use Sluggable;

    protected $fillable = ['title', 'content', 'blocks', 'settings'];
    protected $translatable = ['title', 'content'];
    protected $casts = [
        'blocks' => 'array',
        'settings' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')->singleFile();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getConfig(string $name): mixed
    {
        if (isset($this->settings[$name])) {
            return $this->settings[$name];
        }

        return null;
    }
}
