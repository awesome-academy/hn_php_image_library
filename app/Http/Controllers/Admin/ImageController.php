<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $repository;

    public function __construct(ImageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $images = $this->repository->getAdminSearch($request['search']);

        return view('admin.images.image_index', ['images' => $images]);
    }

    public function destroy(Image $Image)
    {
        $Image->delete();

        return redirect()->route('images.index')
            ->with('success', __('delete_success', ['name' => __('image')]));
    }
}
