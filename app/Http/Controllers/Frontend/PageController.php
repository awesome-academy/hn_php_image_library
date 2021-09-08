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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function saveUpload(ImageRepositoryInterface $imageRepository, ImageRequest $request)
    {
        $user_id = Auth::user()->getAuthIdentifier();
        $imageRepository->saveUpload($request, $user_id);

        return redirect()->route('home.user', ['id' => $user_id]);
    }

    public function editImage(CategoryRepositoryInterface $categoryRepository, Image $image)
    {
        if ($image['user_id'] != Auth::user()->getAuthIdentifier()) {
            abort(404);
        }
        $categories = $categoryRepository->getAllCategory();
        $subcategories = $categoryRepository->getAllSubcategory();

        return view('frontend.edit', [
            'image' => $image,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    public function updateImage(ImagePutRequest $request, Image $image)
    {
        $image->update($request->all());

        return redirect()->back();
    }

    public function deleteImage(Image $image)
    {
        $image->delete();

        return redirect()->route('home.user', ['id' => Auth::user()->getAuthIdentifier()]);
    }
}
