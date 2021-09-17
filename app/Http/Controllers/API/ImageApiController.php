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
    protected $imageRepository;

    protected $commentRepository;

    public function __construct(
        ImageRepositoryInterface $imageRepository,
        CommentRepositoryInterface $commentRepository
    ) {
        $this->imageRepository = $imageRepository;
        $this->commentRepository = $commentRepository;
    }

    public function updateLike(Request $request)
    {
        $like = $this->imageRepository->updateLike($request, Auth::user()->getAuthIdentifier());

        return response($like, 200);
    }

    public function updateShare(Request $request)
    {
        $share = $this->imageRepository->updateShare($request, Auth::user()->getAuthIdentifier());

        return response($share, 200);
    }

    public function homeSearch(Request $request)
    {
        $images = $this->imageRepository->getSearch($request);

        return view('response.home_search', [
            'images' => $images,
        ]);
    }

    public function comment(CommentRequest $request)
    {
        $comment = $this->commentRepository->create($request, $request['image_id'], Auth::user());

        return view('response.comment', ['comment' => $comment]);
    }
}
