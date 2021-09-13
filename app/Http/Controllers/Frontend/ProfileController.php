<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\FollowRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        return view('frontend.profile');
    }

    public function delete()
    {
        return view('frontend.delete');
    }

    public function update(UserRepositoryInterface $userRepository, ProfileRequest $request)
    {
        $userRepository->update(Auth::user(), $request);

        return redirect()->back();
    }

    public function destroy()
    {
        Auth::user()->delete();

        return redirect()->back();
    }

    public function favorites(ImageRepositoryInterface $imageRepository)
    {
        $images = $imageRepository->getImageFavorite(Auth::user()->getAuthIdentifier());

        return view('frontend.favorites', [
            'images' => $images,
        ]);
    }

    public function listFollow(FollowRepositoryInterface $followRepository)
    {
        $follow_users = $followRepository->getUserFollow(Auth::user()->getAuthIdentifier());

        return view('frontend.favorites', [
            'follow_users' => $follow_users,
        ]);
    }

    public function upload(CategoryRepositoryInterface $categoryRepository)
    {
        $categories = $categoryRepository->getAllCategory();

        return view('frontend.upload', [
            'categories' => $categories,
        ]);
    }
}
