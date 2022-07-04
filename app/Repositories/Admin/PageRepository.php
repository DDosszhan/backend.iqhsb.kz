<?php

namespace App\Repositories\Admin;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use StarterKit\Core\Repositories\BaseRepository;

class PageRepository extends BaseRepository
{
    protected $model = \App\Models\Page::class;
}
