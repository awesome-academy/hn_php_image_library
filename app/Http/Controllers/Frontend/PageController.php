<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImagePutRequest;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    protected $categoryRepository;

    protected $imageRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ImageRepositoryInterface $imageRepository
    ) {
        $this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
        $this->imageRepository = $imageRepository;
    }

    public function saveUpload(ImageRequest $request)
    {
        $user_id = Auth::id();
        $this->imageRepository->saveUpload($request, $user_id);

        return redirect()->route('home.user', ['id' => $user_id]);
    }

    public function editImage(Image $image)
    {
        if ($image['user_id'] != Auth::id()) {
            return response()->view('errors.404', [], 404);
        }
        $categories = $this->categoryRepository->getAllCategory();
        $subcategories = $this->categoryRepository->getAllSubcategory();

        return view('frontend.edit', [
            'image' => $image,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    public function updateImage(ImagePutRequest $request, Image $image)
    {
        $image->update($request->all());

        return redirect()->route('home.user', ['id' => Auth::id()]);
    }

    public function deleteImage(Image $image)
    {
        $image->delete();

        return redirect()->route('home.user', ['id' => Auth::id()]);
    }
}
