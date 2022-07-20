<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Faq extends BaseModel
{
    use HasTranslations;

    public $translatable = ['question','answer'];

    protected $guarded = ['id'];
}
