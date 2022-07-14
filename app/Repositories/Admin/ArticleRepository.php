<?php

namespace App\Repositories\Admin;

use StarterKit\Core\Repositories\BaseRepository;

class ArticleRepository extends BaseRepository
{
    protected $model = \App\Models\Article::class;
}
