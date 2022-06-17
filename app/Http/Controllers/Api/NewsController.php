<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\NewsRepository;

class NewsController extends Controller
{
    private NewsRepository $faqRepository;

    public function __construct(NewsRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function index()
    {
        $response = $this->faqRepository->get();
        return response()->json($response);
    }
}
