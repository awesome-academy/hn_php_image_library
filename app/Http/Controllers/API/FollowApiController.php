<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\FollowRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowApiController extends Controller
{
    protected $repository;

    public function __construct(FollowRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function updateFollow(Request $request)
    {
        $follow = $this->repository->updateFollow($request, Auth::user()->getAuthIdentifier());

        return response($follow, 200);
    }
}
