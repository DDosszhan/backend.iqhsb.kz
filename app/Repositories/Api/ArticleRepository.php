<?php

namespace App\Repositories\Api;

use App\Models\Article;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Model;

class ArticleRepository extends BaseApiRepository
{
    protected Model $model;

    public function __construct(Article $model)
    {
        parent::__construct($model);
    }

    public function get()
    {
        return $this->model->select([
            'id',
            'slug',
            'title',
            'published_at',
        ])
            ->where('active', true)
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->get()->each(function ($model) {
                $media = $model->getFirstMedia('default');
                $model->image_url = $media ? $media->getFullUrl() : null;
                $model->makeHidden('media');
            });
    }

    public function getBySlug(string $slug)
    {
        $model = $this->model->select([
            'id',
            'slug',
            'title',
            'content',
            'published_at',
        ])
            ->where('slug', $slug)
            ->where('active', true)
            ->where('published_at', '<=', now())
            ->first();

        if (!$model) {
            throw new ModelNotFoundException("News Not Found");
        }

        $media = $model->getFirstMedia('default');
        $model->image_url = $media ? $media->getFullUrl() : null;
        $model->makeHidden('media');

        /**
         * Обратная совместимость с моделью StarterKit\Models\News
         */
        $model->contents = $model->getOriginal('content');
        $model->makeHidden('content');

        return $model;
    }
}
