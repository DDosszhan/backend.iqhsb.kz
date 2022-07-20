<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Partner extends BaseModel implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    protected $fillable = ['name', 'company', 'description'];
    protected $translatable = ['name', 'company', 'description'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')->singleFile();
    }
}
