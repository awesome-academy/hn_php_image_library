<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ImageRepositoryInterface;

class AdminApiController extends Controller
{
    protected $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function getUploadImageChart()
    {
        return $this->imageRepository->getUploadImageChart();
    }
}
