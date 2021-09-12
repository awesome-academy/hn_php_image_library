<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageApiController extends Controller
{
    protected $repository;

    public function __construct(ImageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function updateLike(Request $request)
    {
        $like = $this->repository->updateLike($request, Auth::user()->getAuthIdentifier());

        return response($like, 200);
    }

    public function updateShare(Request $request)
    {
        $share = $this->repository->updateShare($request, Auth::user()->getAuthIdentifier());

        return response($share, 200);
    }

    public function homeSearch(ImageRepositoryInterface $imageRepository, Request $request)
    {
        $images = $imageRepository->getSearch($request);

        return view('response.home_search', [
            'images' => $images,
        ]);
    }

    public function comment(
        CommentRepositoryInterface $commentRepository,
        CommentRequest $request
    ) {
        $comment = $commentRepository->create($request, $request['image_id'], Auth::user());

        return view('response.comment', ['comment' => $comment]);
    }
}
