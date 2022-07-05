<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\PageRepository;

class PageController extends Controller
{
    private PageRepository $repository;

    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show($slug)
    {
        $response = $this->repository->getPage($slug);
        return response()->json($response);
    }
}
