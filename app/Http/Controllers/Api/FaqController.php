<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\FaqRepository;

class FaqController extends Controller
{
    private FaqRepository $faqRepository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function index()
    {
        $response = $this->faqRepository->get();
        return response()->json($response);
    }
}
