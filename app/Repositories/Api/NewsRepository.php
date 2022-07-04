<?php

namespace App\Repositories\Api;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use StarterKit\News\Models\News;
use Illuminate\Database\Eloquent\Model;

class NewsRepository extends BaseApiRepository
{
    protected Model $model;

    public function __construct(News $model)
    {
        parent::__construct($model);
    }

    public function get()
    {
        return $this->model->select([
            'id',
            'title',
            'published_at',
        ])
            ->where('site_display', true)
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->with('mainImage')
            ->get()->each(function ($model) {
                $image = $model->mainImage;
                $model->image_url = $image ? $image->url : null;
                $model->makeHidden('mainImage');
            });
    }

    public function getById(int $id)
    {
        $model = $this->model->select([
            'id',
            'title',
            'contents',
            'published_at',
        ])
            ->where('id', $id)
            ->where('site_display', true)
            ->where('published_at', '<=', now())
            ->with('mainImage')
            ->first();

        if (!$model) {
            throw new ModelNotFoundException("News with id = '$id' Not Found");
        }

        $model->image_url = $model->mainImage ? $model->mainImage->url : null;
        $model->makeHidden('mainImage');

        return $model;
    }
}
