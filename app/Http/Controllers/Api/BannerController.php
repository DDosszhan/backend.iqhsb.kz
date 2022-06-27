<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\BannerRepository;

class BannerController extends Controller
{
    private BannerRepository $bannerRepository;

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function index()
    {
        $response = $this->bannerRepository->get();
        return response()->json($response);
    }

    public function show($page)
    {
        $response = $this->bannerRepository->getBanner($page);
        return response()->json($response);
    }
}
