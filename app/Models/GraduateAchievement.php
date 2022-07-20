<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class GraduateAchievement extends BaseModel implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    protected $translatable = ['graduate_name', 'description', 'city'];
    protected $fillable = [
        'university_id',
        'graduate_name',
        'description',
        'year',
        'city',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')->singleFile();
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
