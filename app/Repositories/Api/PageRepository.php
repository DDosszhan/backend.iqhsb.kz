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

    public function getPage(string $page)
    {
        $pageModel = $this->model
            ->select(['id', 'title', 'content', 'blocks'])
            ->where('slug', $page)->first();

        if (!$pageModel) {
            throw new ModelNotFoundException("Model with page '$page' Not Found");
        }

        $pageModel->image_url = $pageModel->getFirstMediaUrl('default');
        $pageModel->makeHidden('media');

        return $pageModel;
    }
}
