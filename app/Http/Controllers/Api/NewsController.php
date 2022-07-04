<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\NewsRepository;

class NewsController extends Controller
{
    private NewsRepository $repository;

    public function __construct(NewsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $response = $this->repository->get();
        return response()->json($response);
    }

    public function show(int $id)
    {
        $response = $this->repository->getById($id);
        return response()->json($response);
    }
}
