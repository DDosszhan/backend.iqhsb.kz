<?php

namespace App\Repositories\Api;

use App\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PageRepository extends BaseApiRepository
{
    protected Model $model;

    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

    public function getPage(string $slug)
    {
        $page = $this->model
            ->select(['id', 'title', 'content', 'blocks'])
            ->where('slug', $slug)->first();

        if (!$page) {
            throw new ModelNotFoundException("Model with page '$slug' Not Found");
        }

        $page->image_url = $page->getFirstMedia() ? $page->getFirstMediaUrl('default') : null;
        $page->makeHidden('media');

        $page->gallery = $page->getMedia('gallery')->pluck('original_url');
        $page->makeHidden('media');

        return $page;
    }
}
