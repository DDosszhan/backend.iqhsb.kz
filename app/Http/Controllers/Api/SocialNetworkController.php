<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\SocialNetworkRepository;

class SocialNetworkController extends Controller
{
    private SocialNetworkRepository $socialNetworkRepository;

    public function __construct(SocialNetworkRepository $socialNetworkRepository)
    {
        $this->socialNetworkRepository = $socialNetworkRepository;
    }

    public function index()
    {
        $response = $this->socialNetworkRepository->get();
        return response()->json($response);
    }
}
