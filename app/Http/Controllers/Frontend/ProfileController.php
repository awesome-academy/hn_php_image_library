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
    protected $categoryRepository;

    protected $imageRepository;

    protected $userRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ImageRepositoryInterface $imageRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
        $this->imageRepository = $imageRepository;
        $this->userRepository = $userRepository;
    }

    public function edit()
    {
        return view('frontend.profile');
    }

    public function delete()
    {
        return view('frontend.delete');
    }

    public function destroy()
    {
        $this->userRepository->delete(Auth::id());

        return redirect()->route('home');
    }

    public function update(ProfileRequest $request)
    {
        $this->userRepository->update(Auth::user(), $request);

        return redirect()->route('profile.edit');
    }

    public function favorites()
    {
        $images = $this->imageRepository->getImageFavorite(Auth::id());

        return view('frontend.favorites', [
            'images' => $images,
        ]);
    }

    public function upload()
    {
        $categories = $this->categoryRepository->getAllCategory();

        return view('frontend.upload', [
            'categories' => $categories,
        ]);
    }
}
