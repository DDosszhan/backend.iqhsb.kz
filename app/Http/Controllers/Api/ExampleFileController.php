<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\ExampleFileRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExampleFileController extends Controller
{
    private ExampleFileRepository $repository;

    public function __construct(ExampleFileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function binary(string $slug)
    {
        $model = $this->repository->getModel()->where('slug', $slug)->first();
        if (!$model) {
            throw new NotFoundHttpException();
        }
        $media = $model->getFirstMedia('default');
        if (!$media) {
            throw new NotFoundHttpException();
        }

        return response()->download($media->getPath(), $media->file_name);
    }
}
