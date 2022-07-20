<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialNetwork extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'url'];
}
