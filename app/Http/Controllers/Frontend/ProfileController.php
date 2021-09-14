<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
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

    public function destroy(UserRepositoryInterface $userRepository)
    {
        $userRepository->delete(Auth::id());

        return redirect()->route('home');
    }

    public function update(UserRepositoryInterface $userRepository, ProfileRequest $request)
    {
        $userRepository->update(Auth::user(), $request);

        return redirect()->route('profile.edit');
    }

    public function favorites(ImageRepositoryInterface $imageRepository)
    {
        $images = $imageRepository->getImageFavorite(Auth::id());

        return view('frontend.favorites', [
            'images' => $images,
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
