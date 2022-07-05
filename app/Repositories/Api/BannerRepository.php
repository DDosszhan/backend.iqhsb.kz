<?php

namespace App\Repositories\Api;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BannerRepository extends BaseApiRepository
{
    protected Model $model;

    public function __construct(Banner $model)
    {
        parent::__construct($model);
    }

    public function get()
    {
        return $this->model->select([
            'id',
            'title',
            'content',
            'button_text',
            'button_url',
        ])
            ->orderBy('id', 'desc')
            ->get()
            ->each(function ($model) {
                $model->image_url = $model->getFirstMediaUrl('default');
                $model->makeHidden('media');
                return $model;
            });
    }

    public function getBanner(string $slug)
    {
        $banner = $this->model
            ->select(['id', 'title', 'content', 'button_text', 'button_url'])
            ->where('slug', $slug)->first();

        if (!$banner) {
            throw new ModelNotFoundException("Model with page '$slug' Not Found");
        }

        $banner->image_url = $banner->getFirstMediaUrl('default');
        $banner->makeHidden('media');

        return $banner;
    }
}
